<?php

namespace App\Controllers;

use App\Enums\TemperatureScaleEnum;
use App\Collections\WeatherSources;
use App\Enums\DataSourceEnum;
use App\Services\CalculateWeatherPredictionService;
use App\Services\TemperatureConverterService;
use App\Services\WeatherPredictionService;

class WeatherController
{
    private WeatherPredictionService $weatherService;

    public function __construct()
    {
        $this->weatherService = new WeatherPredictionService();
    }

    public function getWeather(array $params): void
    {
        $city = $params['city'] ?? null;
        if (null === $city) {
            echo "A cidade não foi informada.";
            die();
        }

        $prediction = $this->weatherService
            ->getPredictionByCity($city, TemperatureScaleEnum::celsius());

        echo json_encode([
            'temp' => $prediction->temp(),
            'city' => $prediction->city(),
            'scale' => sprintf('%s', $prediction->scale())
        ]);
    }
}
