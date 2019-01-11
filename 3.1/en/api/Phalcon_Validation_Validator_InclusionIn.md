---
layout: article
language: 'en'
version: '3.1'
title: 'Phalcon\Validation\Validator\InclusionIn'
---
# Class **Phalcon\Validation\Validator\InclusionIn**

*extends* abstract class [Phalcon\Validation\Validator](/3.1/en/api/Phalcon_Validation_Validator)

*implements* [Phalcon\Validation\ValidatorInterface](/3.1/en/api/Phalcon_Validation_ValidatorInterface)

<a href="https://github.com/phalcon/cphalcon/tree/v3.1.0/phalcon/validation/validator/inclusionin.zep" class="btn btn-default btn-sm">Source on GitHub</a>

Check if a value is included into a list of values

```php
<?php

use Phalcon\Validation;
use Phalcon\Validation\Validator\InclusionIn;

$validator = new Validation();

$validator->add(
    "status",
    new InclusionIn(
        [
            "message" => "The status must be A or B",
            "domain"  => ["A", "B"],
        ]
    )
);

$validator->add(
    [
        "status",
        "type",
    ],
    new InclusionIn(
        [
            "message" => [
                "status" => "The status must be A or B",
                "type"   => "The status must be 1 or 2",
            ],
            "domain" => [
                "status" => ["A", "B"],
                "type"   => [1, 2],
            ]
        ]
    )
);

```


## Methods
public  **validate** ([Phalcon\Validation](/3.1/en/api/Phalcon_Validation) $validation, *mixed* $field)

Executes the validation



public  **__construct** ([*array* $options]) inherited from [Phalcon\Validation\Validator](/3.1/en/api/Phalcon_Validation_Validator)

Phalcon\Validation\Validator constructor



public  **isSetOption** (*mixed* $key) inherited from [Phalcon\Validation\Validator](/3.1/en/api/Phalcon_Validation_Validator)

Checks if an option has been defined



public  **hasOption** (*mixed* $key) inherited from [Phalcon\Validation\Validator](/3.1/en/api/Phalcon_Validation_Validator)

Checks if an option is defined



public  **getOption** (*mixed* $key, [*mixed* $defaultValue]) inherited from [Phalcon\Validation\Validator](/3.1/en/api/Phalcon_Validation_Validator)

Returns an option in the validator's options
Returns null if the option hasn't set



public  **setOption** (*mixed* $key, *mixed* $value) inherited from [Phalcon\Validation\Validator](/3.1/en/api/Phalcon_Validation_Validator)

Sets an option in the validator


