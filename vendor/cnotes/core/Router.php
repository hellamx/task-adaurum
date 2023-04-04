<?php

namespace cnotes;
use Exception;

abstract class Router
{
    protected static $routes = [];
    protected static $route = [];

    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    public static function dispatch($url) 
    {
        if (self::matchRoute($url)) {
            $controller = "app\\controllers\\" . self::$route["prefix"] . self::$route["controller"] . "Controller";

            if (class_exists($controller)) {

                $controllerObject = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route["action"]) . "Action";
                
                if (method_exists($controllerObject, $action)) {
                    $controllerObject->$action();
                    $controllerObject->getView();
                } else {
                    throw new Exception("Метод {$controller::$action} не найден", 404);  
                }

            } else {
                throw new Exception("Класс {$controller} не найден", 404);  
            }


        } else {
            throw new Exception("Страница не найдена", 404);
        }
    }

    public static function matchRoute($url)
    {
        $url = self::removeQueryString($url);

        foreach(self::$routes as $pattern => $local_route) {
            if (preg_match("#{$pattern}#i", $url, $matches)) {

                foreach($matches as $k => $v) {
                    if(is_string($k)) {
                        $local_route[$k] = $v;
                    }
                }

                if (empty($local_route["action"])) {
                    $local_route["action"] = "index";
                }

                if (empty($local_route["prefix"])) {
                    $local_route["prefix"] = "";
                } else {
                    $local_route["prefix"] .= "\\";
                }

                $local_route["controller"] = self::upperCamelCase($local_route["controller"]);
                self::$route = $local_route;

                return true;
            }
        }
        
        return false;
    }

    protected static function removeQueryString($url) {
        
        if($url) {
            $params = explode("&", $url, 2);
            
            if (strpos($params[0], "=") === false) {
                return rtrim($params[0], "/");
            } else {
                return "";
            }
        }
    
    }

    protected static function upperCamelCase($name)
    {
        $name = str_replace(" ", "", ucwords(str_replace("-", " ", $name)));
        return $name;
    }

    protected static function lowerCamelCase($name)
    {
        return lcfirst(self::upperCamelCase($name));
    }

    public static function getRoutes()
    {
        return self::$routes;
    }

    public static function getRoute()
    {
        return self::$route;
    }
}

?>