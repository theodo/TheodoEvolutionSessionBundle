<?php

namespace Theodo\Evolution\Bundle\SessionBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('theodo_evolution_session');

        $rootNode
            ->children()
                ->scalarNode('bag_manager_service')->end()
                ->scalarNode('bag_configuration_service')->end()
                ->arrayNode('bag_manager')
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('configuration_class')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
