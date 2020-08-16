<?php

require_once "../vendor/autoload.php";

$route = new \Flame\Router;
$route->post('/vehicle/search', 'CrawlerController@search');
