<?php

use App\Router;

require_once __DIR__ . '/../vendor/autoload.php';

$router = new Router();

$router->get('/api', function () {
    var_dump($_GET);
});

$router->get('/api/get-weather', 'WeatherController@getWeather');

$router->notFound(function () {
    echo "Path Not Found";
});

$router->run();
