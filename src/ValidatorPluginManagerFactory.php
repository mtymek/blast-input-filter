<?php
/**
 * @link      https://github.com/mtymek/blast-input-filter
 * @copyright Copyright (c) 2016-2017 Mateusz Tymek
 * @license   BSD 2-Clause
 */

namespace Blast\InputFilter;

use Interop\Container\ContainerInterface;
use Zend\Validator\ValidatorPluginManager;

class ValidatorPluginManagerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $config = ($config && isset($config['validators']) && is_array($config['validators']))
            ? $config['validators']
            : [];
        return new ValidatorPluginManager($container, $config);
    }
}
