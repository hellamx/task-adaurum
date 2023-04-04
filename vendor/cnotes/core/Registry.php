<?php

namespace cnotes;

class Registry 
{
    use TSingletone;

    public static $properties = [];

    public static function set($name, $value)
    {
        self::$properties[$name] = $value;
    }

    public static function get($name)
    {
        if (isset(self::$properties[$name])) {
            return self::$properties[$name];
        }
        
        return null;
    }

    public static function debug()
    {
        return self::$properties;
    }
}

?>