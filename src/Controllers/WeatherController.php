<?php

namespace App\Controllers;

use App\Enums\TemperatureScaleEnum;
use App\Collections\WeatherSources;
use App\Enums\DataSourceEnum;
use App\Services\CalculateWeatherPredictionService;
use App\Services\TemperatureConverterService;
use App\Services\WeatherPredictionsService;

class WeatherController
{
    public function getWeather(array $params): void
    {
        if (!isset($params['city'])) {
            echo "A cidade não foi informada.";
            die();
        }

        $weatherSources = [DataSourceEnum::climaTempo(), DataSourceEnum::bbc(), DataSourceEnum::openWeather()];
        $sourceCollection = new WeatherSources;
        foreach ($weatherSources as $source) {
            $sourceCollection->add($source);
        }
        
        $weatherPredictions = new WeatherPredictionsService($sourceCollection, $params['city']);
        $predictions = $weatherPredictions->getPredictions();
            $weatherSourcesObj->setSources($weatherSources);

        $temperatureStandardize = new TemperatureConverterService($predictions);
        $temperatureStandardize->standardizeValues(TemperatureScaleEnum::celsius());

        $predictionCalculator = new CalculateWeatherPredictionService($predictions);
        $prediction = $predictionCalculator->calculatePrediction();
        
        echo json_encode([
            'temp' => $prediction->getTemp(),
            'city' => $prediction->getCity()
        ]);
    }
}