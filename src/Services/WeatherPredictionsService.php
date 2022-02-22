<?php

namespace App\Services;

use App\Collections\WeatherSources;
use App\Collections\Predictions;
use App\Factories\DataSourceFactory;

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
        $predictions = new Predictions;
        $factory = new DataSourceFactory;

        foreach ($this->weatherSources as $source) {
            $repository = $factory->create($source, $predictions);
            $repository->fetchWeatherInformation($this->city);
        }

        return $predictions;
    }
}