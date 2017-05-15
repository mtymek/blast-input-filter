<?php
/**
 * @link      https://github.com/mtymek/blast-input-filter
 * @copyright Copyright (c) 2016-2017 Mateusz Tymek
 * @license   BSD 2-Clause
 */

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
