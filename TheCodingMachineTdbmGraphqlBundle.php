<?php


namespace TheCodingMachine\Tdbm\Graphql\Bundle;

use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use TheCodingMachine\Tdbm\Graphql\Bundle\DependencyInjection\TheCodingMachineTdbmGraphqlCompilerPass;

class TheCodingMachineTdbmGraphqlBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new TheCodingMachineTdbmGraphqlCompilerPass(), PassConfig::TYPE_BEFORE_OPTIMIZATION, 1);
    }
}
