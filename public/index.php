<?php

require_once "../vendor/autoload.php";

//$route = new \App\Router;
$route = new \Flame\Router;
$route->post('/index', 'indexController@index');
$route->get('/complete', 'indexController@complete');
$route->get('/model', 'indexController@modelProduct');
