<?php

/*
 * This file is part of the EoAirbrakeBundle package.
 *
 * (c) Eymen Gunay <eymen@egunay.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eo\AirbrakeBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class EoAirbrakeExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $container->setParameter('eo_airbrake.api_key', $config['api_key']);
        $container->setParameter('eo_airbrake.async', $config['async']);
        $container->setParameter('eo_airbrake.host', $config['host']);
        $container->setParameter('eo_airbrake.secure', $config['secure']);

        // Exception Listener
        if ($config['api_key']) {
            // Airbreak Configuration
            $class = $container->getParameter('eo_airbrake.configuration.class');
            $definition = new Definition($class, array($config['api_key'], $config['async'], $container->getParameter('kernel.environment'), $config['host'], $config['secure']));
            $container->setDefinition('eo_airbrake.configuration', $definition);

            // Airbreak Client
            $class = $container->getParameter('eo_airbrake.client.class');
            $definition = new Definition($class, array(new Reference('eo_airbrake.configuration')));
            $container->setDefinition('eo_airbrake.client', $definition);

            // Exception Listener
            $class = $container->getParameter('eo_airbrake.exception_listener.class');
            $definition = new Definition($class, array(new Reference('eo_airbrake.client'), $config['ignored_exceptions']));
            $definition->addTag('kernel.event_listener', array('event' => 'kernel.exception', 'method' => 'onKernelException'));
            $container->setDefinition('php_airbrake.exception_listener', $definition);

            // PHP Shutdown Listener
            $class = $container->getParameter('eo_airbrake.shutdown_listener.class');
            $definition = new Definition($class, array(new Reference('eo_airbrake.client')));
            $definition->addTag('kernel.event_listener', array('event' => 'kernel.controller', 'method' => 'register'));
            $container->setDefinition('php_airbrake.shutdown_listener', $definition);
        }
    }
}
