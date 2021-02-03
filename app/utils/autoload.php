<?php
define('WWW_ROOT', dirname(dirname(dirname(__FILE__))));
define('DS', DIRECTORY_SEPARATOR);

function autoload($class)
{
    $class =  WWW_ROOT . DS . str_replace('\\', DS, $class) . '.php';

    if (!file_exists($class)) {
        throw new Exception("File path '{$class}' not found.");
    }

    require_once($class);
}
