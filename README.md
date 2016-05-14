Blast\InputFilter
=================

[![Build Status](https://travis-ci.org/mtymek/blast-input-filter.svg?branch=master)](https://travis-ci.org/mtymek/blast-input-filter)

**Configuration-based setup of `zend-validator`, `zend-filter` and `zend-inputfilter` for
Zend Expressive applications.**

This package provides factories that allow to define custom filters and validators using
configuration:

```php
return [
    'filters' => [
        'factories' => [
            'Foo' => FooFilterFactory::class,
        ],
    ],
    'validators' => [
        'factories' => [
            'Bar' => BarValidatorFactory::class,
        ],
    ],
];
```

Later on they can be used directly when building an input filter:

```php    
$filter = $factory->createInputFilter(
    [
        [
            'name' => 'name',
            'filters' => [
                ['name' => 'Foo'],
            ],
            'validators' => [
                ['name' => 'Bar'],
            ],
        ],        
    ]
);

return $filter;
```

## Installation

This package supports installation with composer:

```
$ composer require mtymek/blast-input-filter
```

## Usage

### Define your custom filters and validators

`blast-inputfilter` allows to set-up respective plugin managers using `filters`
and `validators` keys:

```php
return [
    'filters' => [
        'factories' => [
            'Foo' => FooFilterFactory::class,
        ],
    ],
    'validators' => [
        'factories' => [
            'Bar' => BarValidatorFactory::class,
        ],
    ],
];
```

This works exaclty like when using `zend-mvc`, only without performance penalty
of ZF's module manager.

### Create input filter

There are couple of ways of creating input filter and injecting it with elements. 
One of them is to use `__construct` method to create all inputs and specify validators:

```php
namespace App\InputFilter;

use Zend\InputFilter\InputFilter;

class ContactInputFilter extends InputFilter
{
    public function __construct()
    {
        $this->add(
            [
                'name' => 'name',
                'filters' => [
                    ['name' => 'Foo'],
                ],
                'validators' => [
                    ['name' => 'Bar'],
                ],
            ]
        );

        $this->add(
            [
                'name' => 'content',
                'filters' => [
                    ['name' => 'StringTrim'],
                ],
            ]
        );
    }
}
```

### Create factory for your filter

In order for custom filters and validators to work, you need to pull `Zend\InputFilter\Factory` 
from service container and inject it into your input filter:

```php

namespace App\InputFilter;

use Interop\Container\ContainerInterface;
use Zend\InputFilter\Factory;

class ContactInputFilterFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $inputFilter = new ContactForm();
        $inputFilter->setFactory($container->get(Factory::class));
        return $inputFilter;
    }
}
```

Please note that you can use more generic factory to instantiate more input
filters:

```php

namespace App\InputFilter;

use Interop\Container\ContainerInterface;
use Zend\InputFilter\Factory;

class InputFilterFactory
{
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $inputFilter = new $requestedName();
        $inputFilter->setFactory($container->get(Factory::class));
        return $inputFilter;
    }
}
```
