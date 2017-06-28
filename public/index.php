<?php

use Docs\Main;
use Phalcon\Di\FactoryDefault as PhDi;

// Register the auto loader
require __DIR__.'/../bootstrap/autoloader.php';

try {
    (new Main())->run(new PhDi());
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL . $e->getTraceAsString();
}
