<?php

namespace TheCodingMachine\Tdbm\GraphQL\Bundle\Tests;

use Laminas\Code\Generator\FileGenerator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use TheCodingMachine\Tdbm\GraphQL\Bundle\Tests\Fixtures\ExposeConfiguration;
use TheCodingMachine\TDBM\Utils\BeanDescriptor;
use TheCodingMachine\GraphQLite\Annotations\Field;

class FunctionalTest extends KernelTestCase
{
    protected static function createKernel(array $options = [])
    {
        return new TdbmGraphQLTestingKernel('test', true);
    }

    public function testServiceWiring()
    {
        self::bootKernel();

        // returns the real and unchanged service container
        //$container = self::$kernel->getContainer();

        // gets the special container that allows fetching private services
        $container = self::$container;

        $configuration = $container->get(ExposeConfiguration::class)->getConfiguration();
        $codeGeneratorListener = $configuration->getCodeGeneratorListener();

        // If the generator is registered, a call to onBaseBeanGenerated will add a GraphqlField to the file generated.
        $fileGenerator = new FileGenerator();
        $beanDescriptor = $this->createMock(BeanDescriptor::class);

        $fileGenerator = $codeGeneratorListener->onBaseBeanGenerated($fileGenerator, $beanDescriptor, $configuration);

        $this->assertContains([
            Field::class,
            'GraphqlField'
        ], $fileGenerator->getUses());
    }
}
