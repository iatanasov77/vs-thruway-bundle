<?php namespace Vankosoft\ThruwayBundle;

use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Vankosoft\ThruwayBundle\DependencyInjection\Compiler\AnnotationConfigurationPass;
use Vankosoft\ThruwayBundle\DependencyInjection\Compiler\GlobalTaggedServicesPass;
use Vankosoft\ThruwayBundle\DependencyInjection\Compiler\ServiceConfigurationPass;

/**
 * Class VSThruwayBundle
 * @package Vankosoft\ThruwayBundle
 */
class VSThruwayBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     * @throws \LogicException
     */
    public function build( ContainerBuilder $container ): void
    {
        $passConfig = $container->getCompilerPassConfig();
        $passConfig->addPass( new AnnotationConfigurationPass( $container->getParameter( 'kernel.bundles_metadata' ) ) );
        $passConfig->addPass( new ServiceConfigurationPass() );
        $container->addCompilerPass( new GlobalTaggedServicesPass() );

        $container->loadFromExtension( 'framework', [
            'serializer' => [
                'enabled' => true,
            ],
        ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new \Vankosoft\ThruwayBundle\DependencyInjection\VSThruwayExtension();
    }
}
