<?php

namespace Blast\Test\InputFilter;

use Blast\InputFilter\ConfigProvider;
use PHPUnit_Framework_TestCase;
use Zend\ServiceManager\ServiceManager;

class ConfigProviderTest extends PHPUnit_Framework_TestCase
{
    public function testProvidesValidServiceConfig()
    {
        $configProvider = new ConfigProvider();
        $config = $configProvider();

        $serviceManager = new ServiceManager($config['dependencies']);
        $serviceManager->setService('config', $config);
        foreach ($config['dependencies']['factories'] as $class => $factory) {
            $this->assertTrue($serviceManager->has($class));
            $this->assertInstanceOf($class, $serviceManager->get($class));
        }
    }
}
