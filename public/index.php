<?php

require_once "../vendor/autoload.php";

$route = new \Flame\Router;
$route->post('/search', 'CrawlerController@searchVehicle');
$route->post('/vehicle', 'CrawlerController@getVehicle');
