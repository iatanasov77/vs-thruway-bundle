<?php namespace Vankosoft\ThruwayBundle;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Serializer;
use Doctrine\DBAL\Driver\Connection;
use Psr\Log\LoggerInterface;
use React\Promise\Promise;
use Thruway\CallResult;
use Thruway\ClientSession;
use Thruway\Peer\Client;
use Thruway\Transport\TransportInterface;
use Thruway\WampErrorException;
use Vankosoft\ThruwayBundle\Annotation\Register;
use Vankosoft\ThruwayBundle\Annotation\Subscribe;
use Vankosoft\ThruwayBundle\Event\SessionEvent;
use Vankosoft\ThruwayBundle\Mapping\MappingInterface;
use Vankosoft\ThruwayBundle\Mapping\URIClassMapping;

/**
 * Class WampKernel
 *
 * @package Vankosoft\ThruwayBundle
 */
class WampKernel implements WampKernelInterface
{
    /* @var $session ClientSession */
    protected $session;

    /** @var TransportInterface */
    protected $transport;

    /** @var ContainerInterface */
    protected $container;

    /** @var Client */
    protected $client;

    /** @var Serializer */
    protected $serializer;

    /** @var ResourceMapper */
    protected $resourceMapper;

    /** @var EventDispatcherInterface */
    protected $dispatcher;

    /** @var null */
    protected $processName;

    /** @var */
    protected $processInstance;

    /** @var LoggerInterface */
    protected $logger;

    /**
     * @param ContainerInterface $container
     * @param Serializer $serializer
     * @param ResourceMapper $resourceMapper
     * @param EventDispatcherInterface $dispatcher
     * @param LoggerInterface $logger
     */
    public function __construct(
        ContainerInterface $container,
        Serializer $serializer = null,
        ResourceMapper $resourceMapper,
        EventDispatcherInterface $dispatcher,
        LoggerInterface $logger
    ) {
        $this->container      = $container;
        $this->serializer     = $serializer;
        $this->resourceMapper = $resourceMapper;
        $this->dispatcher     = $dispatcher;
        $this->logger         = $logger;
    }

    /**
     * @param ClientSession $session
     * @param TransportInterface $transport
     */
    public function onOpen( ClientSession $session, TransportInterface $transport ): void
    {
        $this->session   = $session;
        $this->transport = $transport;
        $mappings        = $this->resourceMapper->getMappings( $this->processName );

        $event = new SessionEvent( $session, $transport, $this->processName, $this->processInstance, $mappings );
        $this->dispatcher->dispatch( WampEvents::OPEN, $event );

        //Map RPC calls and subscriptions to their controllers
        $this->mapResources( $mappings );
    }

    /**
     * Go through all of the resource mappings for this worker process and create the corresponding WAMP URIs
     * @param $mappings
     */
    protected function mapResources( $mappings ): void
    {
        /* @var $mapping URIClassMapping */
        foreach ( $mappings as $mapping ) {
            if ( $mapping->getAnnotation() instanceof Register ) {

                $this->createRPC( $mapping );

                $this->sendAuthorization( $mapping, 'call' );

            } elseif ( $mapping->getAnnotation() instanceof Subscribe ) {

                $this->createSubscribe( $mapping );

                $this->sendAuthorization( $mapping, 'subscribe' );
            }
        }
    }

    /**
     * Register an RPC
     *
     * @param MappingInterface $mapping
     */
    protected function createRPC( MappingInterface $mapping ): void
    {
        /* @var $annotation Register */
        $annotation       = $mapping->getAnnotation();
        $multiRegister    = $annotation->getMultiRegister() !== null ? $annotation->getMultiRegister() : true;
        $discloseCaller   = $annotation->getDiscloseCaller() !== null ? $annotation->getDiscloseCaller() : true;
        $object           = $this->container->get( $mapping->getServiceId() );
        $registerCallback = $annotation->getRegisterCallback() ? [$object, $annotation->getRegisterCallback()] : null;

        /**
         * If this isn't the first worker process to be created, we can't register this RPC call again.
         */
        if ( $this->processInstance > 0 && !$multiRegister ) {
            return;
        }

        //RPC Options
        $callOptions = [
            'disclose_caller'          => $discloseCaller,
            'thruway_multiregister'    => $multiRegister,
            'replace_orphaned_session' => $annotation->getReplaceOrphanedSession()
        ];

        //RPC Callback
        $rpcCallback = function ( $args, $kwargs, $details ) use ( $mapping ) {
            $rawResult = $this->handleRPC( $args, $kwargs, $details, $mapping );

            //Run the results through serializer
            return $this->serializeResult( $rawResult, $mapping );
        };

        //Register the RPC Call
        $this->session->register( $annotation->getName(), $rpcCallback, $callOptions )->then( $registerCallback );
    }

    /**
     * Handle the RPC
     *
     * @param $args
     * @param $argsKw
     * @param $details
     * @param MappingInterface $mapping
     * @return mixed|static
     * @throws \Exception
     */
    public function handleRPC( $args, $argsKw, $details, MappingInterface $mapping ): mixed
    {
        //@todo match up $kwargs to the method arguments

        try {
            //Force cleanup before making the call
            $this->cleanup();

            $newContainer = ContainerFactory::createContainer(
                $this->container->getParameter( 'kernel.container_class' ),
                $this->container->get( 'thruway.client' ),
                $this->container->get( 'vs_thruway.thruway.loop' ),
                $this->container
            );

            $controller = $newContainer->get( $mapping->getServiceId() );

            $controllerArgs = $this->deserializeArgs( $args, $mapping );

            $this->setControllerContainerDetails( $controller, $args, $argsKw, $details );
            $this->setControllerContainerUser( $controller, $details );

            //Call Controller
            $rawResult = call_user_func_array( [$controller, $mapping->getMethod()->getName()], $controllerArgs );

            //Do clean on the controller
            $this->cleanup( $controller );

            return $rawResult;

        } catch ( WampErrorException $e ) {
            throw $e;
        } catch ( \Exception $e ) {
            $this->cleanup();
            $message = "Unable to make the call: {$mapping->getAnnotation()->getName()} \n Message:  {$e->getMessage()} \n {$e->getFile()}:{$e->getLine()}";
            $this->logger->critical( $message );
            throw new \Exception( $message );
        }
    }

    /**
     * Subscribe to a topic
     *
     * @param MappingInterface $mapping
     */
    protected function createSubscribe( MappingInterface $mapping ): void
    {
        /**
         * @var Subscribe $annotation
         */
        $annotation = $mapping->getAnnotation();

        $topic = $annotation->getName();

        $subscribeCallback = function ( $args, $argsKw, $details ) use ( $mapping ) {
            $this->handleEvent( $args, $argsKw, $details, $mapping );
        };

        $options = [];

        if ( $match = $annotation->getMatch() ) {
            $options['match'] = $match;
        }

        //Subscribe to a topic
        $this->session->subscribe( $topic, $subscribeCallback, $options );
    }

    /**
     * Run the RPC result through JMS serializer, so that entities get serialized properly
     *
     * @param $rawResult
     * @param $mapping
     * @return mixed|Promise
     */
    public function serializeResult( $rawResult, $mapping ): mixed
    {
        //Create a serialization context
        $context = $this->createSerializationContext( $mapping );

        if ( $rawResult instanceof Promise ) {
            return $rawResult->then( function ( $d ) use ( $context ) {
                //If the data is a CallResult, we only want to serialize the first argument
                $d      = $d instanceof CallResult ? [$d[0]] : $d;
                $result = is_array( $d ) ? $d : [$d];

                return $this->serializer->normalize( $result, null, $context );
            });
        }

        $result = is_array( $rawResult ) ? $rawResult : [$rawResult];
        return $this->serializer->normalize( $result, null, $context );
    }

    /**
     * Handle an subscription Event
     *
     * @param $args
     * @param MappingInterface $mapping
     * @throws \Exception
     */
    public function handleEvent( $args, $argsKw, $details, MappingInterface $mapping ): void
    {
        try {
            //Force clean up before calling the subscribed method
            $this->cleanup();

            $controller     = $this->container->get( $mapping->getServiceId() );
            $controllerArgs = $this->deserializeArgs( $args, $mapping );

            $this->setControllerContainerDetails( $controller, $args, $argsKw, $details );
            $this->setControllerContainerUser( $controller, $details );

            //Call Controller
            call_user_func_array( [$controller, $mapping->getMethod()->getName()], $controllerArgs );

            $this->cleanup( $controller );

        } catch ( \Exception $e ) {
            $this->cleanup();
            $message = "Unable to publish to: {$mapping->getAnnotation()->getName()} \n Message:  {$e->getMessage()}";
            $this->logger->critical( $message );
            throw new \Exception( $message );
        }
    }

    /**
     * @param $controller
     * @return mixed
     */
    protected function getControllerContainer( $controller ): mixed
    {
        if ( ! $controller instanceof ContainerAwareInterface ) {
            return null;
        }

        $reflectController = new \ReflectionClass( $controller );

        $containerProperty = $reflectController->getProperty( 'container' );
        $containerProperty->setAccessible( true );

        return $containerProperty->getValue( $controller );
    }

    /**
     * @param $controller
     * @param $details
     */
    protected function setControllerContainerUser( $controller, $details ): void
    {
        $container = $this->getControllerContainer( $controller );

        if ( ! $container ) {
            return;
        }

        if ( ! isset( $details->authid ) ) {
            return;
        }

        $user = $this->authenticateAuthId( $details->authid, $container );

        // Newer version of symfony have Controller::getUser(), so this isn't really needed anymore.  Leaving this here for BC.
        //Inject the User object if the UserAware trait in in use
        $traits = class_uses( $controller );
        if ( isset( $traits['Vankosoft\ThruwayBundle\DependencyInjection\UserAwareTrait'] ) ) {

            if ( $user ) {
                $controller->setUser( $user );
            }
        }
    }

    /**
     * @param $controller
     * @param $args
     * @param $argsKw
     * @param $details
     */
    protected function setControllerContainerDetails( $controller, $args, $argsKw, $details ): void
    {
        $container = $this->getControllerContainer( $controller );

        if ( ! $container) {
            return;
        }

        $container->set( 'thruway.details', new Details( $args, $argsKw, $details ) );
    }

    /**
     * Create serialization context with settings taken from the controller's annotation
     *
     * @param MappingInterface $mapping
     * @return array
     */
    protected function createSerializationContext( MappingInterface $mapping ): array
    {
        $context = [];
        if ( $mapping->getAnnotation()->getSerializerEnableMaxDepthChecks() ) {
            $context['enable_max_depth'] = true;
        }

        if ( $mapping->getAnnotation()->getSerializerGroups() ) {
            $context['groups'] = $mapping->getAnnotation()->getSerializerGroups();
        }

        if ( $mapping->getAnnotation()->getSerializerSerializeNull() ) {
            //@todo not sure if this support in symfony serializer
        }

        return $context;
    }


    /**
     * @param Client $client
     */
    public function setClient( Client $client ): void
    {
        $this->client = $client;
        $this->client->on( 'open', [$this, 'onOpen'] );
    }

    /**
     * Deserialize Controller arguments
     *
     * //@todo add ability to configure the deserialization context
     *
     * @param $args
     * @param MappingInterface $mapping
     * @return array|bool
     */
    protected function deserializeArgs( $args, MappingInterface $mapping ): mixed
    {
        try {
            if ( $this->isAssoc( $args ) ) {
                $args = [$args];
            }

            $deserializedArgs = [];

            if ( $mapping->getMethod()->getNumberOfRequiredParameters() > count( $args ) ) {
                throw new \Exception(
                    "Not enough parameters for '{$mapping->getMethod()->class}::{$mapping->getMethod()->getName()}'"
                );
            }

            /* @var $params \ReflectionParameter[] */
            $params = $mapping->getmethod()->getParameters();

            foreach ( $args as $key => $arg ) {
                $className = null;
                if ( isset( $params[$key] ) && $params[$key]->getClass() && $params[$key]->getClass()->getName() ) {
                    if ( ! $params[$key]->getClass()->isInstantiable() ) {

                        throw new \Exception(
                            "Can't deserialize to '{$params[$key]->getClass()->getName()}', because it is not instantiable."
                        );
                    }

                    $arg                = is_array( $arg ) ? $arg : (array)$arg;
                    $className          = $params[$key]->getClass()->getName();
                    $deserializedArgs[] = $this->serializer->denormalize( $arg, $className );

                } else {
                    $deserializedArgs[] = $arg;
                }
            }

            return $deserializedArgs;

        } catch ( \Exception $e ) {
            $this->logger->emergency( $e->getMessage() );
        }

        return [];
    }

    /**
     * @param $authid
     * @param ContainerInterface $container
     * @return UserInterface
     */
    protected function authenticateAuthId( $authid, ContainerInterface $container ): ?UserInterface
    {
        $user = null;

        //Use the global container so every call uses the same instance of the user provider
        $config = $this->container->getParameter( 'vs_thruway' );

        if ( $container->has( $config['user_provider'] ) ) {
            $user = $container->get( $config['user_provider'] )->loadUserByUsername( $authid );
        }

        $user = $user ?: new User( $authid, null );
        $this->authenticateUser( $user, $container );

        return $user;
    }

    /**
     * @param UserInterface $user
     * @param ContainerInterface $container
     * @throws \InvalidArgumentException
     */
    protected function authenticateUser(UserInterface $user, ContainerInterface $container): void
    {
        $providerKey = 'thruway';
        $token       = new UsernamePasswordToken($user, null, $providerKey, $user->getRoles());

        //Use the controller's container to set the token
        $container->get( 'security.token_storage' )->setToken( $token );
    }

    /**
     * @param $arr
     * @return bool
     */
    protected function isAssoc( $arr ): bool
    {
        return array_keys( $arr ) !== range( 0, count( $arr ) - 1 );
    }

    /**
     *  Cleanup
     * @param $controller
     */
    protected function cleanup( $controller = null ): void
    {
        //Do some doctrine cleanup on the controller container.
        $controllerContainer = $this->getControllerContainer( $controller );

        if ( $controllerContainer && $controllerContainer->has( 'doctrine' ) ) {
            if ( ! $controllerContainer->get( 'doctrine' )->getManager()->isOpen() ) {
                $controllerContainer->get( 'doctrine' )->resetManager();
            }
            $controllerContainer->get( 'doctrine' )->getManager()->clear();

            //Close any open doctrine connections
            /** @var Connection[] $connections */
            $connections = $controllerContainer->get( 'doctrine' )->getConnections();

            foreach ( $connections as $connection ) {
                $connection->close();
            }
        }

        //Clear out any stuff that doctrine has cached
        if ( $this->container->has( 'doctrine' ) ) {
            if ( ! $this->container->get( 'doctrine' )->getManager()->isOpen() ) {
                $this->container->get( 'doctrine' )->resetManager();
                $config = $this->container->getParameter( 'vs_thruway' );

                if ( $this->container->has( $config['user_provider'] ) ) {
                    $this->container->set( $config['user_provider'], null );
                }
            }
            $this->container->get( 'doctrine' )->getManager()->clear();
        }

        if ( $controller ){
            gc_collect_cycles();
        }
    }

    /**
     * //Not tested
     *
     * @param URIClassMapping $mapping
     * @param $action
     */
    public function sendAuthorization( URIClassMapping $mapping, $action ): void
    {
        $uri   = $mapping->getAnnotation()->getName();
        $roles = $this->extractRoles( $mapping );

        foreach ( $roles as $role ) {
            $this->session
                ->call('add_authorization_rule', [
                    [
                        'role'   => $role,
                        'action' => $action,
                        'uri'    => $uri,
                        'allow'  => true
                    ]
                ])
                ->then(
                    function ( $r ) {
                        echo "Sent authorization\n";
                    },
                    function ( $msg ) {
                        echo "Failed to send authorization\n";
                    });
        }
    }

    /**
     * @param URIClassMapping $mapping
     * @return array
     */
    protected function extractRoles( URIClassMapping $mapping ): array
    {
        $roles = [];

        $securityAnnotation = $mapping->getSecurityAnnotation();

        if ( $securityAnnotation ) {

            $expression = $securityAnnotation->getExpression();

            preg_match_all( "/'(.*?)'/", $expression, $matches );
            $roles = $matches[1];
        }

        return $roles;
    }

    public function handle( Request $request, int $type = self::MAIN_REQUEST, bool $catch = true ): Response
    {
        // TODO: Implement handle() method.
        return new Response( 'NOT IMPLEMENTED' );
    }

    /**
     * @return ResourceMapper
     */
    public function getResourceMapper(): ResourceMapper
    {
        return $this->resourceMapper;
    }

    /**
     * @param null $processName
     */
    public function setProcessName( $processName ): void
    {
        $this->processName = $processName;
    }

    /**
     * @param mixed $processInstance
     */
    public function setProcessInstance( $processInstance ): void
    {
        $this->processInstance = $processInstance;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @return ClientSession
     */
    public function getSession(): ClientSession
    {
        return $this->session;
    }
}
