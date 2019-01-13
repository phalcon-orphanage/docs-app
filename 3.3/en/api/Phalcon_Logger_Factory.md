---
layout: article
language: 'en'
version: '3.3'
title: 'Phalcon\Logger\Factory'
---
# Class **Phalcon\Logger\Factory**

*extends* abstract class [Phalcon\Factory](/3.3/en/api/Phalcon_Factory)

*implements* [Phalcon\FactoryInterface](/3.3/en/api/Phalcon_FactoryInterface)

<a href="https://github.com/phalcon/cphalcon/tree/v3.3.0/phalcon/logger/factory.zep" class="btn btn-default btn-sm">Source on GitHub</a>

Loads Logger Adapter class using 'adapter' option

```php
<?php

use Phalcon\Logger\Factory;

$options = [
    "name"    => "log.txt",
    "adapter" => "file",
];
$logger = Factory::load($options);

```


## Methods
public static  **load** ([Phalcon\Config](/3.3/en/api/Phalcon_Config) | *array* $config)





protected static  **loadClass** (*mixed* $namespace, *mixed* $config)

...


