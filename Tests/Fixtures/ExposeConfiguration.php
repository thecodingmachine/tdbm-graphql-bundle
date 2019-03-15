<?php


namespace TheCodingMachine\Tdbm\Graphql\Bundle\Tests\Fixtures;


use TheCodingMachine\TDBM\Configuration;

class ExposeConfiguration
{
    /**
     * @var Configuration
     */
    private $configuration;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @return Configuration
     */
    public function getConfiguration(): Configuration
    {
        return $this->configuration;
    }
}