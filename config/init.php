<?php
 
// 1 - разработка, 0 - продакшн
define("DEBUG", 1);

// корень сайта

$root_replaced = str_replace("\\", "/", (dirname(__DIR__)));
define("ROOT", $root_replaced);

// указывает на публичную папку
define("WWW", ROOT . "/public");

// указывает на папку с приложением
define("APP", ROOT . "/app");

// указывает на папку с ядром приложения
define("CORE", ROOT . "/vendor/cnotes/core");

// указывает на папку с библиотеками
define("LIBS", ROOT . "/vendor/cnotes/core/libs");

// указывает на папку с кэшем
define("CACHE", ROOT . "/tmp/cache");

// указывает на папку с конфигурацией
define("CONFIG", ROOT . "/config");

// название шаблона сайта
define("LAYOUT", "default");

// директория сайта
$app_path = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}";
$app_path = preg_replace("#[^/]+$#", "", $app_path);
$app_path = str_replace("/public/", "", $app_path);

define("PATH", $app_path);

// путь к админке сайта
define("ADMIN", PATH . "/admin");

// composer
require_once ROOT . "/vendor/autoload.php";

?>