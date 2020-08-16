<?php

require_once "../vendor/autoload.php";

$route = new \Flame\Router;
$route->get('/index', 'indexController@index');
