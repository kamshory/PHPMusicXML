<?php

spl_autoload_register(function ($class) {
    $file = __DIR__.'/classes/' . $class . '.php';
    $file = str_replace("\\", "/", $file);
    if(file_exists($file))
    {
        require_once $file;
    }
});
