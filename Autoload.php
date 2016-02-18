<?php

namespace Nostromo;

/**
 * Class Autoloader.
 */
class Autoload
{
    public static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    public static function autoload($class)
    {
        $parts = preg_split('#\\\#', $class);

        $className = array_pop($parts);

        $path = implode('\\', $parts);

        $class = str_replace($path, strtolower($path), $class);
        $class = str_replace('\\', DS, $class);
        $class = str_replace(strtolower(__NAMESPACE__).DS, '', $class);

        require ROOT.$class.'.php';
    }
}
