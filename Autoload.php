<?php
namespace Nostromo;

/**
 * Class Autoloader
 * @package Nostromo
 */
class Autoloader
{
    public static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    public static function autoload($class)
    {
        $class = str_replace(__NAMESPACE__.DS, '', $class);
        require ROOT.$class.'.php';
    }
}
