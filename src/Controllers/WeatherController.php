<?php

namespace App\Controllers;

use App\Models\WeatherSources;
use App\Repositories\BBCWeatherRepository;
use App\Repositories\ClimaTempoWeatherRepository;
use App\Repositories\OpenWeatherMapRepository;
use App\Services\CalculateWeatherPredictionService;
use App\Services\WeatherPredictionsService;

class WeatherController
{
    public function getWeather(array $params): string
    {
        $weatherSources = [ClimaTempoWeatherRepository::class, BBCWeatherRepository::class, OpenWeatherMapRepository::class];
        $weatherSourcesObj = new WeatherSources();
        $weatherSourcesObj->setSources($weatherSources);

        $weatherPredictionsObj = new WeatherPredictionsService($weatherSourcesObj, $params['city']);
        $predictions = $weatherPredictionsObj->getPredictions();

        $predictionMediaObj = new CalculateWeatherPredictionService($predictions);
        $prediction = $predictionMediaObj->calculatePrediction();

        return json_encode([
            'temp' => $prediction->getTemp(),
            'city' => $prediction->getCity()
        ]);
    }
}