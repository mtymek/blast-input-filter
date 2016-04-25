<?php

namespace Blast\InputFilter;

use Zend\Filter\FilterPluginManager;
use Zend\InputFilter\Factory;
use Zend\InputFilter\InputFilterPluginManager;
use Zend\Validator\ValidatorPluginManager;

class ConfigProvider
{
    public function __invoke()
    {
        return [
            'dependencies' => $this->getServiceConfig(), 
        ];
    }

    private function getServiceConfig()
    {
        return [
            'factories' => [
                InputFilterPluginManager::class => InputFilterManagerFactory::class,
                FilterPluginManager::class => FilterPluginManagerFactory::class,
                ValidatorPluginManager::class => ValidatorPluginManagerFactory::class,
                Factory::class => InputFilterFactoryFactory::class,
            ],
        ];
    }

}
