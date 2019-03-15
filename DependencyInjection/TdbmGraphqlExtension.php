<?php


namespace TheCodingMachine\Tdbm\Graphql\Bundle\DependencyInjection;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use TheCodingMachine\Tdbm\GraphQL\GraphQLTypeAnnotator;

class TdbmGraphqlExtension extends Extension
{

    /**
     * Loads a specific configuration.
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config/container'));
        $loader->load('tdbmgraphql.xml');

        $definition = $container->getDefinition(GraphQLTypeAnnotator::class);
        $definition->replaceArgument(0, $config['type_namespace']);
        $definition->replaceArgument(1, $config['generated_type_namespace']);
    }
}
