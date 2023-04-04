<?php

use cnotes\Router;

Router::add("^company/(?P<alias>[0-9-]+)/?$", ["controller" => "Company", "action" => "index"]);

Router::add("^$", ["controller" => "Main", "action" => "index"]);
Router::add("^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$");

?>