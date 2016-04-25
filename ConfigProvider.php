<?php

namespace Blast\InputFilter;

use Blast\InputFilter\InputFilterManagerFactory;
use Zend\InputFilter\InputFilterPluginManager;

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
            ],
        ];
    }
}
