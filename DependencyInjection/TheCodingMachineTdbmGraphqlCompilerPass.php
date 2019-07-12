<?php


namespace TheCodingMachine\Tdbm\Graphql\Bundle\DependencyInjection;

use function class_exists;
use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\Common\Annotations\AnnotationReader as DoctrineAnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Cache\ApcuCache;
use function function_exists;
use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\ObjectType;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use function str_replace;
use function strpos;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use TheCodingMachine\GraphQLite\AnnotationReader;
use TheCodingMachine\GraphQLite\Annotations\Mutation;
use TheCodingMachine\GraphQLite\Annotations\Query;
use TheCodingMachine\Graphqlite\Bundle\Mappers\ContainerFetcherTypeMapper;
use TheCodingMachine\Graphqlite\Bundle\QueryProviders\ControllerQueryProvider;
use TheCodingMachine\GraphQLite\FieldsBuilderFactory;
use TheCodingMachine\GraphQLite\InputTypeGenerator;
use TheCodingMachine\GraphQLite\InputTypeUtils;
use TheCodingMachine\GraphQLite\Mappers\GlobTypeMapper;
use TheCodingMachine\GraphQLite\Mappers\RecursiveTypeMapperInterface;
use TheCodingMachine\GraphQLite\Mappers\StaticTypeMapper;
use TheCodingMachine\GraphQLite\NamingStrategy;
use TheCodingMachine\GraphQLite\TypeGenerator;
use TheCodingMachine\GraphQLite\Types\MutableObjectType;
use TheCodingMachine\GraphQLite\Types\ResolvableInputObjectType;
use TheCodingMachine\TDBM\Configuration;
use TheCodingMachine\Tdbm\GraphQL\GraphQLTypeAnnotator;

/**
 * Detects controllers and types automatically and tag them.
 */
class TheCodingMachineTdbmGraphqlCompilerPass implements CompilerPassInterface
{
    /**
     * This Compiler pass adds the GraphQLTypeAnnotator to TDBM configuration
     */
    public function process(ContainerBuilder $container)
    {
        $configuration = $container->findDefinition(Configuration::class);
        $arguments = $configuration->getArguments();

        $generationListeners = $arguments[7] ?? [];
        $codeGenerationListeners = $arguments[9] ?? [];

        $generationListeners[] = new Reference(GraphQLTypeAnnotator::class);
        $codeGenerationListeners[] = new Reference(GraphQLTypeAnnotator::class);

        $configuration->setArgument(7, $generationListeners);
        $configuration->setArgument(9, $codeGenerationListeners);
    }
}
