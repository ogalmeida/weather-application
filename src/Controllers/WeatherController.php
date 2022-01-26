<?php

namespace App\Controllers;

use App\Models\WeatherSources;
use App\Repositories\BBCWeatherRepository;
use App\Repositories\ClimaTempoWeatherRepository;
use App\Repositories\OpenWeatherMapRepository;
use App\Services\CalculateWeatherPredictionService;
use App\Services\TemperatureConverterService;
use App\Services\WeatherPredictionsService;

class WeatherController
{
    public function getWeather(array $params): string
    {
        if (!isset($params['city'])) {
            echo "A cidade não foi informada.";
            die();
        }

        $weatherSources = [ClimaTempoWeatherRepository::class, BBCWeatherRepository::class, OpenWeatherMapRepository::class];
        
        try {
            $weatherSourcesObj = new WeatherSources();
            $weatherSourcesObj->setSources($weatherSources);
            
            $weatherPredictionsObj = new WeatherPredictionsService($weatherSourcesObj, $params['city']);
            $predictions = $weatherPredictionsObj->getPredictions();
            
            $temperatureConverterObj = new TemperatureConverterService($predictions);
            $temperatureConverterObj->standardizeValues('celsius');
            
            $predictionMediaObj = new CalculateWeatherPredictionService($predictions);
            $prediction = $predictionMediaObj->calculatePrediction();
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            die();
        }

        return json_encode([
            'temp' => $prediction->getTemp(),
            'city' => $prediction->getCity()
        ]);
    }
}