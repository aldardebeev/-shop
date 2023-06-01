<?php

use MyNamespace\App;
spl_autoload_register(function ($class){

    $root = dirname(__DIR__);
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    $path = preg_replace('#^MyNamespace#', $root, $path);
    print_r($path);

    if (file_exists($path)) {
        require_once $path;
        return true;
    }
    return false;
});


$object = new App();
$object->run();


