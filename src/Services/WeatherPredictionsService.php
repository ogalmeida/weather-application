<?php

namespace App\Services;

use App\Models\Predictions;
use App\Models\WeatherSources;

class WeatherPredictionsService
{
    private $city;
    private $weatherSources;

    public function __construct(WeatherSources $weatherSources, string $city)
    {
        $this->city = $city;
        $this->weatherSources = $weatherSources;
    }

    public function getPredictions(): Predictions
    {
        $predictions = new Predictions();

        foreach ($this->weatherSources->getSources() as $source) {
            $this->getSourcesPrediction($source, $predictions);
        }

        return $predictions;
    }

    private function getSourcesPrediction(string $source, Predictions $predictions): void
    {
        $obj = new $source($predictions);
        $obj->getAllWeatherInformation($this->city);
    }
}