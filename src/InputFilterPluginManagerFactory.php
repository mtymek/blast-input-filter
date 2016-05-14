<?php

namespace Blast\InputFilter;

use Interop\Container\ContainerInterface;
use Zend\InputFilter\InputFilterPluginManager;

class InputFilterPluginManagerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $config = ($config && isset($config['input_filters']) && is_array($config['input_filters']))
            ? $config['input_filters']
            : [];
        return new InputFilterPluginManager($container, $config);
    }
}