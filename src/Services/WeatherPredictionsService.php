<?php

namespace App\Services;

use App\Collections\Predictions;
use App\Models\WeatherSources;

class WeatherPredictionsService
{
    private string $city;
    private WeatherSources $weatherSources;

    public function __construct(WeatherSources $weatherSources, string $city)
    {
        $this->city = $city;
        $this->weatherSources = $weatherSources;
    }

    public function getPredictions(): Predictions
    {
        $predictions = new Predictions();

        foreach ($this->weatherSources->getSources() as $source) {
            $this->fetchSourcePrediction($source, $predictions);
        }

        return $predictions;
    }

    private function fetchSourcePrediction(string $source, Predictions $predictions): void
    {
        $obj = new $source($predictions);
        $obj->fetchWeatherInformation($this->city);
    }
}