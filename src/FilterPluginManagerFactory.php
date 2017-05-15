<?php
/**
 * @link      https://github.com/mtymek/blast-input-filter
 * @copyright Copyright (c) 2016-2017 Mateusz Tymek
 * @license   BSD 2-Clause
 */

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
