<?php

namespace App\Repositories;

use App\Entity\Prediction;
use App\Enums\TemperatureScaleEnum;
use App\Repositories\Contract\WeatherDataSourceRepositoryInterface;
use App\Exceptions\WeatherDataSourceConnectionException;

class OpenWeatherMapRepository implements WeatherDataSourceRepositoryInterface
{
    private const FILE_PATH = __DIR__ . '/../../data/openweathermap.json';

    public function getPredictionByCity(string $city): Prediction
    {
        $fileContent = $this->loadFileContent();

        $dataFromCity = $fileContent[$city];

        if (null === $dataFromCity) {
            throw new CityNotFoundException();
        }

        return Prediction::fromArray([
            'city' => $dataFromCity['name'],
            'temp' => (float) $dataFromCity['temperatures']['temp'],
            'scale' => TemperatureScaleEnum::kelvin(),
        ]);
    }

    private function loadFileContent(): array
    {
        $fileContent = file_get_contents(self::FILE_PATH);

        if (false === $fileContent) {
            throw new WeatherDataSourceConnectionException();
        }

        return json_decode($fileContent, true);
    }
}
