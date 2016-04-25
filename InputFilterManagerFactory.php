<?php

namespace BlastInput;

use Interop\Container\ContainerInterface;
use Zend\InputFilter\InputFilterPluginManager;

class InputFilterManagerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $config = ($config && is_array($config['input_filters']))
            ? $config['input_filters']
            : [];
        return new InputFilterPluginManager($container, $config);
    }
}
