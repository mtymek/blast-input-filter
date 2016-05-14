<?php

namespace Blast\InputFilter;

use Interop\Container\ContainerInterface;
use Zend\Filter\FilterPluginManager;

class FilterPluginManagerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $config = ($config && isset($config['filters']) && is_array($config['filters']))
            ? $config['filters']
            : [];
        return new FilterPluginManager($container, $config);
    }
}
