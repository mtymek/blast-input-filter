<?php

namespace Blast\InputFilter;

use Interop\Container\ContainerInterface;
use Zend\Validator\ValidatorPluginManager;

class ValidatorPluginManagerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $config = ($config && is_array($config['validators']))
            ? $config['validators']
            : [];
        return new ValidatorPluginManager($container, $config);
    }
}
