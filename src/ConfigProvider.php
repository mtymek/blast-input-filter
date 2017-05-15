<?php
/**
 * @link      https://github.com/mtymek/blast-input-filter
 * @copyright Copyright (c) 2016-2017 Mateusz Tymek
 * @license   BSD 2-Clause
 */

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
                InputFilterPluginManager::class => InputFilterPluginManagerFactory::class,
                FilterPluginManager::class => FilterPluginManagerFactory::class,
                ValidatorPluginManager::class => ValidatorPluginManagerFactory::class,
                Factory::class => InputFilterFactoryFactory::class,
            ],
        ];
    }
}
