<?php

namespace Blast\Test\InputFilter;

use Blast\InputFilter\InputFilterFactoryFactory;
use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase;
use Zend\Filter\FilterPluginManager;
use Zend\InputFilter\Factory;
use Zend\InputFilter\InputFilterPluginManager;
use Zend\Validator\ValidatorPluginManager;

class InputFilterFactoryFactoryTest extends PHPUnit_Framework_TestCase
{
    public function testInjectsFilterAndValidatorManagersFromContainer()
    {
        $factory = new InputFilterFactoryFactory();
        $container = $this->prophesize(ContainerInterface::class);
        $inputFilterPluginManager = $this->prophesize(InputFilterPluginManager::class);
        $filterPluginManager = $this->prophesize(FilterPluginManager::class);
        $validatorPluginManager = $this->prophesize(ValidatorPluginManager::class);
        $container->get(InputFilterPluginManager::class)->willReturn($inputFilterPluginManager->reveal());
        $container->get(FilterPluginManager::class)->willReturn($filterPluginManager->reveal());
        $container->get(ValidatorPluginManager::class)->willReturn($validatorPluginManager->reveal());
        $inputFilterFactory = $factory($container->reveal());
        $this->assertInstanceOf(Factory::class, $inputFilterFactory);

        $this->assertSame($inputFilterPluginManager->reveal(), $inputFilterFactory->getInputFilterManager());
        $this->assertSame(
            $filterPluginManager->reveal(),
            $inputFilterFactory->getDefaultFilterChain()->getPluginManager()
        );
        $this->assertSame(
            $validatorPluginManager->reveal(),
            $inputFilterFactory->getDefaultValidatorChain()->getPluginManager()
        );
    }
}
