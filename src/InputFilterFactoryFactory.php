<?php

namespace Blast\InputFilter;

use Interop\Container\ContainerInterface;
use Zend\Filter\FilterPluginManager;
use Zend\InputFilter\Factory;
use Zend\InputFilter\InputFilterPluginManager;
use Zend\Validator\ValidatorPluginManager;

class InputFilterFactoryFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $factory = new Factory($container->get(InputFilterPluginManager::class));
        $factory->getDefaultFilterChain()->setPluginManager($container->get(FilterPluginManager::class));
        $factory->getDefaultValidatorChain()->setPluginManager($container->get(ValidatorPluginManager::class));

        return $factory;
    }
}
