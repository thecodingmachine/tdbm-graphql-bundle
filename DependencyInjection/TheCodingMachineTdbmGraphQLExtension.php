<?php


namespace TheCodingMachine\Tdbm\GraphQL\Bundle\DependencyInjection;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class TheCodingMachineTdbmGraphQLExtension extends Extension
{

    /**
     * Loads a specific configuration.
     *
     * @param array<mixed, mixed> $configs
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     */
    public function load(array $configs, ContainerBuilder $container) : void
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config/container'));
        $loader->load('tdbmgraphql.xml');
    }
}
