<?php

    spl_autoload_register("autoload");


function autoload($class_name):void
{
    $array_paths = array(
        '../model/',
        '../config/',
        '../controller/'
    );
    $parts = explode('\\', $class_name);
    $name = array_pop($parts);
    foreach ($array_paths as $path) {
        $file = sprintf($path . '%s.php', $name);
        if (is_file($file)) {
            require_once $file;
        }
    }
}

