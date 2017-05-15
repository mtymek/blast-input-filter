<?php
/**
 * @link      https://github.com/mtymek/blast-input-filter
 * @copyright Copyright (c) 2016-2017 Mateusz Tymek
 * @license   BSD 2-Clause
 */

namespace Blast\Test\InputFilter;

use Blast\InputFilter\InputFilterPluginManagerFactory;
use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use Zend\InputFilter\InputFilterPluginManager;

class InputFilterPluginManagerFactoryTest extends PHPUnit_Framework_TestCase
{
    public function testCreatesPluginManagerFromDefault()
    {
        $config = [];
        $factory = new InputFilterPluginManagerFactory();
        $container = $this->prophesize(ContainerInterface::class);
        $container->get('config')->willReturn($config);
        $pluginManager = $factory($container->reveal());
        $this->assertInstanceOf(InputFilterPluginManager::class, $pluginManager);
    }

    public function testCreatesPluginManagerFromConfig()
    {
        $config = [
            'input_filters' => [
                'factories' => [
                    'foo' => 'FooFactory'
                ],
            ],
        ];

        $factory = new InputFilterPluginManagerFactory();
        $container = $this->prophesize(ContainerInterface::class);
        $container->get('config')->willReturn($config);
        $pluginManager = $factory($container->reveal());
        $this->assertInstanceOf(InputFilterPluginManager::class, $pluginManager);
        $this->assertTrue($pluginManager->has('foo'));
    }
}
