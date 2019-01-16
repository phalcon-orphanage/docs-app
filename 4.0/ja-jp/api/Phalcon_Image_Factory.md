---
layout: article
language: 'ja-jp'
version: '4.0'
title: 'Phalcon\Image\Factory'
---
# Class **Phalcon\Image\Factory**

*extends* abstract class [Phalcon\Factory](api/Phalcon_Factory)

*implements* [Phalcon\FactoryInterface](api/Phalcon_FactoryInterface)

<a href="https://github.com/phalcon/cphalcon/tree/v4.0.0/phalcon/image/factory.zep" class="btn btn-default btn-sm">GitHub上のソース</a>

Loads Image Adapter class using 'adapter' option

```php
<?php

use Phalcon\Image\Factory;

$options = [
    "width"   => 200,
    "height"  => 200,
    "file"    => "upload/test.jpg",
    "adapter" => "imagick",
];
$image = Factory::load($options);

```

## メソッド

public static **load** ([Phalcon\Config](api/Phalcon_Config) | *array* $config)

protected static **loadClass** (*mixed* $namespace, *mixed* $config)

...