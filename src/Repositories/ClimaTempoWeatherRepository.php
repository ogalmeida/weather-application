<?php

namespace App\Repositories;

use App\Entity\Prediction;
use App\Enums\TemperatureScaleEnum;
use App\Repositories\Contract\WeatherDataSourceRepositoryInterface;
use App\Exceptions\WeatherDataSourceConnectionException;
use App\Exceptions\CityNotFoundException;

class ClimaTempoWeatherRepository implements WeatherDataSourceRepositoryInterface
{
    private const FILE_PATH = __DIR__ . '/../../data/climatempo.csv';

    public function getPredictionByCity(string $city): Prediction
    {
        $fileContent = $this->loadFileContent();

        $dataFromCity = $fileContent[$city];

        if (null === $dataFromCity) {
            throw new CityNotFoundException();
        }

        return Prediction::fromArray([
            'city' => $dataFromCity['name'],
            'temp' => (float) $dataFromCity['temp'],
            'scale' => TemperatureScaleEnum::fahrenheit(),
        ]);
    }

    private function loadFileContent(): array
    {
        $file = fopen(self::FILE_PATH, 'r');

        if (false === $file) {
            throw new WeatherDataSourceConnectionException();
        }

        $fields = array_flip(fgetcsv($file));

        $output = [];
        while (($data = fgetcsv($file, 0, ',')) !== FALSE) {
            $output[$data[$fields['_key']]] = [
                'name'    => $data[$fields['name']],
                'temp'    => $data[$fields['temp']],
                'country' => $data[$fields['country']],
            ];
        }
        fclose($file);

        return $output;
    }
}
