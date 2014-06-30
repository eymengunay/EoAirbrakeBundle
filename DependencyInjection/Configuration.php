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

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('eo_airbrake');

        $rootNode
            ->children()
                ->scalarNode('api_key')->defaultFalse()->end()
                ->booleanNode('async')->defaultTrue()->end()
                ->scalarNode('host')->defaultValue('api.airbrake.io')->end()
                ->scalarNode('secure')->defaultTrue()->end()
                ->variableNode('ignored_exceptions')->defaultValue(array('Symfony\Component\HttpKernel\Exception\HttpException'))->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
