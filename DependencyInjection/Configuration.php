<?php


namespace TheCodingMachine\Tdbm\Graphql\Bundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('tdbm-graphql');

        $rootNode
            ->children()
            ->scalarNode('type_namespace')->defaultValue('App\\Types')->end()
            ->scalarNode('generated_type_namespace')->defaultValue(null)->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
