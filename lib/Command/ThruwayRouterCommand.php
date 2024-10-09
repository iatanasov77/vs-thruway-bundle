<?php namespace Vankosoft\ThruwayBundle\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Thruway\Transport\RatchetTransportProvider;
use Vankosoft\ApplicationBundle\Command\ContainerAwareCommand;

#[AsCommand(
    name: 'thruway:router:start',
    description: 'Start the default Thruway WAMP router',
    hidden: false
)]
class ThruwayRouterCommand extends ContainerAwareCommand
{
    /**
     * @var \Psr\Log\LoggerInterface $logger
     */
    private $logger;

    /**
     * Called by the Service Container.
     */
    public function setLogger( \Psr\Log\LoggerInterface $logger ): void
    {
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure(): void
    {
        $this
            ->setHelp( 'The <info>%command.name%</info> starts the Thruway WAMP router.' );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute( InputInterface $input, OutputInterface $output ): int
    {
        if ( $this->getParameter('voryx_thruway')['enable_logging'] ) {
            \Thruway\Logging\Logger::set( $this->logger );
        } else {
            \Thruway\Logging\Logger::set( new \Psr\Log\NullLogger() );
        }

        try {
            $output->writeln( 'Making a go at starting the Thruway Router' );

            //Configure stuff
            $config = $this->getParameter( 'voryx_thruway' );

            //Get the Router Service
            $server = $this->get( 'voryx.thruway.server' );

            //Trusted provider (bound to loopback and requires no authentication)
            $trustedProvider = new RatchetTransportProvider( $config['router']['ip'], $config['router']['trusted_port'] );
            $trustedProvider->setTrusted( true );
            $server->addTransportProvider( $trustedProvider );

            $server->start();

        } catch ( \Exception $e ) {
            $this->logger->critical( 'EXCEPTION:' . $e->getMessage() );
            $output->writeln( 'EXCEPTION:' . $e->getMessage() );
        }
        
        return Command::SUCCESS;
    }
}
