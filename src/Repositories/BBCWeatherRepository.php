<?php

namespace App\Repositories;

use App\Enums\TemperatureScaleEnum;
use App\Entity\Prediction;
use App\Exceptions\CityNotFoundException;
use App\Repositories\Contract\WeatherDataSourceRepositoryInterface;
use App\Exceptions\WeatherDataSourceConnectionException;

class BBCWeatherRepository implements WeatherDataSourceRepositoryInterface
{
    private const FILE_PATH = __DIR__ . '/../../data/bbc.xml';

    /**
     * @throws CityNotFoundException
     * @throws WeatherDataSourceConnectionException
     */
    public function getPredictionByCity(string $city): Prediction
    {
        $fileContent = $this->loadFileContent();

        $dataFromCity = $fileContent[$city];

        if (null === $dataFromCity) {
            throw new CityNotFoundException();
        }

        return Prediction::fromArray([
            'city' => $dataFromCity['name'],
            'temp' => (float) $dataFromCity['temperature'],
            'scale' => TemperatureScaleEnum::celsius(),
        ]);
    }

    private function loadFileContent(): array
    {
        $fileContent = file_get_contents(self::FILE_PATH);

        if (false === $fileContent) {
            throw new WeatherDataSourceConnectionException();
        }

        $fileContent = simplexml_load_string($fileContent);
        $fileContent = json_decode(json_encode($fileContent), true);

        return $fileContent;
    }
}
