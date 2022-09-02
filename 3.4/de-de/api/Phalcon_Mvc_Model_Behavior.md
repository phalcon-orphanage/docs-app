---
layout: default
language: 'de-de'
title: 'Phalcon\Mvc\Model\Behavior'
---
# Abstract class **Phalcon\Mvc\Model\Behavior**

*implements* [Phalcon\Mvc\Model\BehaviorInterface](/3.4/en/api/Phalcon_Mvc_Model_BehaviorInterface)

<a href="https://github.com/phalcon/cphalcon/tree/v3.4.0/phalcon/mvc/model/behavior.zep" class="btn btn-default btn-sm">Source on GitHub</a>

This is an optional base class for ORM behaviors


## Methods
public  **__construct** ([*array* $options])





protected  **mustTakeAction** (*mixed* $eventName)

Checks whether the behavior must take action on certain event



protected *array* **getOptions** ([*string* $eventName])

Returns the behavior options related to an event



public  **notify** (*mixed* $type, [Phalcon\Mvc\ModelInterface](/3.4/en/api/Phalcon_Mvc_ModelInterface) $model)

This method receives the notifications from the EventsManager



public  **missingMethod** ([Phalcon\Mvc\ModelInterface](/3.4/en/api/Phalcon_Mvc_ModelInterface) $model, *string* $method, [*array* $arguments])

Acts as fallbacks when a missing method is called on the model




<hr>

# Class **Phalcon\Mvc\Model\Behavior\SoftDelete**

*extends* abstract class [Phalcon\Mvc\Model\Behavior](/3.4/en/api/Phalcon_Mvc_Model_Behavior)

*implements* [Phalcon\Mvc\Model\BehaviorInterface](/3.4/en/api/Phalcon_Mvc_Model_BehaviorInterface)

<a href="https://github.com/phalcon/cphalcon/tree/v3.4.0/phalcon/mvc/model/behavior/softdelete.zep" class="btn btn-default btn-sm">Source on GitHub</a>

Instead of permanently delete a record it marks the record as
deleted changing the value of a flag column


## Methods
public  **notify** (*mixed* $type, [Phalcon\Mvc\ModelInterface](/3.4/en/api/Phalcon_Mvc_ModelInterface) $model)

Listens for notifications from the models manager



public  **__construct** ([*array* $options]) inherited from [Phalcon\Mvc\Model\Behavior](/3.4/en/api/Phalcon_Mvc_Model_Behavior)

Phalcon\Mvc\Model\Behavior



protected  **mustTakeAction** (*mixed* $eventName) inherited from [Phalcon\Mvc\Model\Behavior](/3.4/en/api/Phalcon_Mvc_Model_Behavior)

Checks whether the behavior must take action on certain event



protected *array* **getOptions** ([*string* $eventName]) inherited from [Phalcon\Mvc\Model\Behavior](/3.4/en/api/Phalcon_Mvc_Model_Behavior)

Returns the behavior options related to an event



public  **missingMethod** ([Phalcon\Mvc\ModelInterface](/3.4/en/api/Phalcon_Mvc_ModelInterface) $model, *string* $method, [*array* $arguments]) inherited from [Phalcon\Mvc\Model\Behavior](/3.4/en/api/Phalcon_Mvc_Model_Behavior)

Acts as fallbacks when a missing method is called on the model




<hr>

# Class **Phalcon\Mvc\Model\Behavior\Timestampable**

*extends* abstract class [Phalcon\Mvc\Model\Behavior](/3.4/en/api/Phalcon_Mvc_Model_Behavior)

*implements* [Phalcon\Mvc\Model\BehaviorInterface](/3.4/en/api/Phalcon_Mvc_Model_BehaviorInterface)

<a href="https://github.com/phalcon/cphalcon/tree/v3.4.0/phalcon/mvc/model/behavior/timestampable.zep" class="btn btn-default btn-sm">Source on GitHub</a>

Allows to automatically update a model’s attribute saving the
datetime when a record is created or updated


## Methods
public  **notify** (*mixed* $type, [Phalcon\Mvc\ModelInterface](/3.4/en/api/Phalcon_Mvc_ModelInterface) $model)

Listens for notifications from the models manager



public  **__construct** ([*array* $options]) inherited from [Phalcon\Mvc\Model\Behavior](/3.4/en/api/Phalcon_Mvc_Model_Behavior)

Phalcon\Mvc\Model\Behavior



protected  **mustTakeAction** (*mixed* $eventName) inherited from [Phalcon\Mvc\Model\Behavior](/3.4/en/api/Phalcon_Mvc_Model_Behavior)

Checks whether the behavior must take action on certain event



protected *array* **getOptions** ([*string* $eventName]) inherited from [Phalcon\Mvc\Model\Behavior](/3.4/en/api/Phalcon_Mvc_Model_Behavior)

Returns the behavior options related to an event



public  **missingMethod** ([Phalcon\Mvc\ModelInterface](/3.4/en/api/Phalcon_Mvc_ModelInterface) $model, *string* $method, [*array* $arguments]) inherited from [Phalcon\Mvc\Model\Behavior](/3.4/en/api/Phalcon_Mvc_Model_Behavior)

Acts as fallbacks when a missing method is called on the model




<hr>

# Interface **Phalcon\Mvc\Model\BehaviorInterface**

<a href="https://github.com/phalcon/cphalcon/tree/v3.4.0/phalcon/mvc/model/behaviorinterface.zep" class="btn btn-default btn-sm">Source on GitHub</a>

## Methods
abstract public  **notify** (*mixed* $type, [Phalcon\Mvc\ModelInterface](/3.4/en/api/Phalcon_Mvc_ModelInterface) $model)

...


abstract public  **missingMethod** ([Phalcon\Mvc\ModelInterface](/3.4/en/api/Phalcon_Mvc_ModelInterface) $model, *mixed* $method, [*mixed* $arguments])

...
