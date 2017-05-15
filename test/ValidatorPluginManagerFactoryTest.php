<?php
/**
 * @link      https://github.com/mtymek/blast-input-filter
 * @copyright Copyright (c) 2016-2017 Mateusz Tymek
 * @license   BSD 2-Clause
 */

namespace Blast\Test\InputValidator;

use Blast\InputFilter\ValidatorPluginManagerFactory;
use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use Zend\Validator\ValidatorPluginManager;

class ValidatorPluginManagerFactoryTest extends PHPUnit_Framework_TestCase
{
    public function testCreatesPluginManagerFromDefault()
    {
        $config = [];
        $factory = new ValidatorPluginManagerFactory();
        $container = $this->prophesize(ContainerInterface::class);
        $container->get('config')->willReturn($config);
        $pluginManager = $factory($container->reveal());
        $this->assertInstanceOf(ValidatorPluginManager::class, $pluginManager);
    }

    public function testCreatesPluginManagerFromConfig()
    {
        $config = [
            'validators' => [
                'factories' => [
                    'foo' => 'FooFactory'
                ],
            ],
        ];

        $factory = new ValidatorPluginManagerFactory();
        $container = $this->prophesize(ContainerInterface::class);
        $container->get('config')->willReturn($config);
        $pluginManager = $factory($container->reveal());
        $this->assertInstanceOf(ValidatorPluginManager::class, $pluginManager);
        $this->assertTrue($pluginManager->has('foo'));
    }
}
