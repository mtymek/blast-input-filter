<?php
/**
 * @link      https://github.com/mtymek/blast-input-filter
 * @copyright Copyright (c) 2016-2017 Mateusz Tymek
 * @license   BSD 2-Clause
 */

namespace Blast\Test\InputFilter;

use Blast\InputFilter\FilterPluginManagerFactory;
use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use Zend\Filter\FilterPluginManager;

class FilterPluginManagerFactoryTest extends PHPUnit_Framework_TestCase
{
    public function testCreatesPluginManagerFromDefault()
    {
        $config = [];
        $factory = new FilterPluginManagerFactory();
        $container = $this->prophesize(ContainerInterface::class);
        $container->get('config')->willReturn($config);
        $pluginManager = $factory($container->reveal());
        $this->assertInstanceOf(FilterPluginManager::class, $pluginManager);
    }

    public function testCreatesPluginManagerFromConfig()
    {
        $config = [
            'filters' => [
                'factories' => [
                    'foo' => 'FooFactory'
                ],
            ],
        ];

        $factory = new FilterPluginManagerFactory();
        $container = $this->prophesize(ContainerInterface::class);
        $container->get('config')->willReturn($config);
        $pluginManager = $factory($container->reveal());
        $this->assertInstanceOf(FilterPluginManager::class, $pluginManager);
        $this->assertTrue($pluginManager->has('foo'));
    }
}
