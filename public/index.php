<?php

use App\Router;

require_once __DIR__ . '/../vendor/autoload.php';

$router = new Router();

$router->get('/', function () {
    echo "
        <div>
            <h2>This is a Weather API!</h2>

            <p>
                With a given city, we'll read weather data from different sources, and generate and average temperature for you!
            </p>

            <h4>Pease access <b style=\"background-color: #ccc\">/api/get-weather?city=<choosed_city></b> with one of the cities below, to get the average temperature:</h4>
            <ul>
                <li>
                    catalao
                </li>
                <li>
                    goiania
                </li>
                <li>
                    uberlandia
                </li>
            </ul>
        </div>
    ";
});

$router->get('/api/get-weather', 'WeatherController@getWeather');

$router->notFound(function () {
    echo "Path Not Found";
});

$router->run();
