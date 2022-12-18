<?php

namespace App\Services;

use App\Collections\PredictionCollection;
use App\Entity\Prediction;
use App\Enums\TemperatureScaleEnum;
use App\Enums\WeatherDataSourceEnum;
use App\Factories\WeatherDataSourceFactory;
use App\Helper\TemperatureConverter;

class WeatherPredictionService
{
    private array $weatherDataSources;

    public function __construct()
    {
        $this->weatherDataSources = [
            WeatherDataSourceEnum::bbc(),
            WeatherDataSourceEnum::climaTempo(),
            WeatherDataSourceEnum::openWeather(),
        ];
    }

    public function getPredictionByCity(string $city, TemperatureScaleEnum $scale): Prediction
    {
        $sourcesPredictions = $this->getStandardizedPredictionFromAllSources($city, $scale);

        $averageTemperature = $this->calculateAverageTemperature($sourcesPredictions);

        return Prediction::fromArray([
            'city' => $sourcesPredictions->first()->city(),
            'temp' => $averageTemperature,
            'scale' => $scale
        ]);
    }

    private function getStandardizedPredictionFromAllSources(string $city, TemperatureScaleEnum $scale): PredictionCollection
    {
        $predictionCollection = new PredictionCollection();
        foreach ($this->weatherDataSources as $source) {
            $weatherDataSourceRepository = WeatherDataSourceFactory::create($source);

            $predictionCollection->add(
                $weatherDataSourceRepository->getPredictionByCity($city)
            );
        }

        return TemperatureConverter::standardizeValues(
            $predictionCollection,
            $scale
        );
    }

    private function calculateAverageTemperature(PredictionCollection $predictions): float
    {
        $averageTemperature = 0;

        /** @var Prediction $prediction */
        foreach ($predictions as $prediction) {
            $averageTemperature += $prediction->temp();
        }

        return $averageTemperature / $predictions->count();
    }
}
