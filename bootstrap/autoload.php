<?php

spl_autoload_register(function ($class) {

    $prefix = 'App\\';

    if (strpos($class, $prefix) === 0) {
        $class = substr($class, strlen($prefix));
    }

    $path = str_replace('\\', '/', $class);
    $file = APP_PATH . '/' . $path . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});