---
layout: default
language: 'ja-jp'
version: '4.0'
title: '名前空間'
keywords: 'namespaces, namespaced classes'
---

# 名前空間

* * *

![](/assets/images/document-status-stable-success.svg) ![](/assets/images/version-{{ pageVersion }}.svg)

## 概要

[Namespaces](https://php.net/manual/en/language.namespaces.php) can be used to avoid class name collisions. This means that if you have two controllers in an application with the same name, a namespace can be used help PHP understand that they are two different classes. Namespaces are also useful when creating bundles or modules.

## 機能の有効化

If you decided to use namespaces for your application, you will need to instruct your autoloader on where your namespaces reside. This is the most common way to distinguish between namespaces in your application. If you chose to use the [Phalcon\Loader](loader) component, then you will need to register your namespaces accordingly:

```php
<?php

$loader->registerNamespaces(
    [
       'MyApp\Admin\Controllers' => '/app/web/admin/controllers/',
       'MyApp\Admin\Models'      => '/app/web/admin/models/',
    ]
);
```

You can also specify the namespace when defining your routes, using the [Router](routing) component:

```php
<?php

$router->add(
    '/admin/invoices/list',
    [
        'namespace'  => 'MyApp\Admin',
        'controller' => 'Invoices',
        'action'     => 'list',
    ]
);
```

or passing it as part of the route as a parameter

```php
<?php

$router->add(
    '/:namespace/invoices/list',
    [
        'namespace'  => 1,
        'controller' => 'Invoices',
        'action'     => 'list',
    ]
);
```

Finally, if you are only working with the same namespace for every controller, you can define a default namespace in your [Dispatcher](dispatcher). Doing so, you will not need to specify the full class in the router path:

```php
<?php

use Phalcon\Mvc\Dispatcher;

$di->set(
    'dispatcher',
    function () {
        $dispatcher = new Dispatcher();

        $dispatcher->setDefaultNamespace(
            'MyApp\Admin\Controllers'
        );

        return $dispatcher;
    }
);
```

## コントローラ

The following example shows how to implement a controller that uses namespaces:

```php
<?php

namespace MyApp\Admin\Controllers;

use Phalcon\Mvc\Controller;

class InvoicesController extends Controller
{
    public function indexAction()
    {

    }

    public function listAction()
    {

    }
}
```

## モデル

The following example shows a model that is namespaced:

```php
<?php

namespace MyApp\Admin\Models;

use Phalcon\Mvc\Model;

class Invoices extends Model
{

}
```

If models have relationships they must include the namespace too:

```php
<?php

namespace MyApp\Admin\Models;

use Phalcon\Mvc\Model;

class Invoices extends Model
{
    public function initialize()
    {
        $this->hasMany(
            'inv_cst_id',
            Customers::class,
            'cst_id',
            [
                'alias' => 'customers',
            ]
        );
    }
}
```

In PHQL you must write the statements including namespaces:

```php
<?php

$phql = 'SELECT i.* '
      . 'FROM MyApp\Admin\Models\Invoices i '
      . 'JOIN MyApp\Admin\Models\Customers c';
```