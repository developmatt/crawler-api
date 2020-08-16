<?php

require_once "../vendor/autoload.php";

$route = new \Flame\Router;
$route->post('/search', 'CrawlerController@searchVehicle');
$route->post('/vehicle', 'CrawlerController@getVehicle');

if(!$route->found) {
    echo json_encode([
        'status' => http_response_code(404),
        'message' => 'Resource not found'
    ]);
}
