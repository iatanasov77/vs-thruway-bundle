<?php namespace Vankosoft\ThruwayBundle\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Thruway\Peer\Client;
use Thruway\Peer\ClientInterface;
use Thruway\Transport\PawlTransportProvider;
use React\Socket\ConnectorInterface;
use Vankosoft\ThruwayBundle\WampKernelInterface;
use Vankosoft\ThruwayBundle\Annotation\Worker as WorkerAnnotation;
use Vankosoft\ApplicationBundle\Command\ContainerAwareCommand;

#[AsCommand(
    name: 'thruway:worker:start',
    description: 'Start Thruway WAMP worker',
    hidden: false
)]
class ThruwayWorkerCommand extends ContainerAwareCommand
{
    /** @var \Psr\Log\LoggerInterface $logger */
    protected $logger;
    
    /** @var WampKernelInterface */
    protected $wampKernel;
    
    /** @var ConnectorInterface */
    protected $connector;

    public function __construct(
        ContainerInterface $container,
        ManagerRegistry $doctrine,
        ValidatorInterface $validator,
        WampKernelInterface $wampKernel,
        ConnectorInterface $connector
    ) {
        parent::__construct( $container, $doctrine, $validator );
        
        $this->wampKernel   = $wampKernel;
        $this->connector    = $connector;
    }
    
    /**
     * Called by the Service Container.
     */
    public function setLogger( LoggerInterface $logger ): void
    {
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure(): void
    {
        $this
            ->setHelp( 'The <info>%command.name%</info> starts the Thruway WAMP client.' )
            ->addArgument( 'name', InputArgument::REQUIRED, 'The name of the worker you\'re starting' )
            ->addArgument( 'instance', InputArgument::OPTIONAL, 'Worker instance number', 0 );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute( InputInterface $input, OutputInterface $output ): int
    {
        if ( $this->getParameter( 'vs_thruway.enable_logging' ) ) {
            \Thruway\Logging\Logger::set( $this->logger );
        } else {
            \Thruway\Logging\Logger::set(new \Psr\Log\NullLogger());
        }

        try {
            $output->write( "Making a go at starting a Thruway worker." );

            $name               = $input->getArgument( 'name' );
            $kernel             = $this->wampKernel;
            $workerAnnotation   = $kernel->getResourceMapper()->getWorkerAnnotation( $name );
            $client             = $this->getClient( $workerAnnotation );
            
            $kernel->setProcessName( $name );
            $kernel->setClient( $client, $this->connector );
            $kernel->setProcessInstance( $input->getArgument( 'instance' ) );

            $client->start();

        } catch ( \Exception $e ) {
            $this->logger->critical( 'EXCEPTION:' . $e->getMessage() );
            $output->writeln( 'EXCEPTION:' . $e->getMessage() );
        }
        
        return Command::SUCCESS;
    }
    
    protected function getClient( ?WorkerAnnotation $workerAnnotation = null ): ClientInterface
    {
        $loop   = $this->get( 'vs_thruway.thruway.loop' );
        
        if ( $workerAnnotation ) {
            $realm = $workerAnnotation->getRealm() ?: $this->getParameter( 'vs_thruway.realm' );
            $url   = $workerAnnotation->getUrl() ?: $this->getParameter( 'vs_thruway.url' );
        } else {
            $realm = $this->getParameter( 'vs_thruway.realm' );
            $url   = $this->getParameter( 'vs_thruway.url' );
        }
        
        $transport = new PawlTransportProvider( $url );
        $client    = new Client( $realm, $loop );
        
        $client->addTransportProvider( $transport );
        
        return $client;
    }
}
