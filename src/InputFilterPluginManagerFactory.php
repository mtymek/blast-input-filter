<?php
/**
 * @link      https://github.com/mtymek/blast-input-filter
 * @copyright Copyright (c) 2016-2017 Mateusz Tymek
 * @license   BSD 2-Clause
 */

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
