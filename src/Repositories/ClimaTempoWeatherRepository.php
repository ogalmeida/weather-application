<?php

namespace App\Repositories;

use App\Models\Prediction;
use App\Models\Predictions;
use App\Repositories\DataSourceRepositoryInterface;

class ClimaTempoWeatherRepository implements DataSourceRepositoryInterface
{
    private const FILE_PATH = __DIR__ . '/../../data/climatempo.csv';
    private $predictions;

    public function __construct(Predictions $predictions)
    {
        $this->predictions = $predictions;
    }

    public function getAllWeatherInformation(string $city): void
    {
        $data = $this->getData();
        
        $prediction = new Prediction($data[$city]['temp'], $data[$city]['name'], 'fahrenheit');
        
        $this->predictions->addPrediction($prediction);
    }

    private function getData(): array
    {
        $fileContent = $this->readFile();

        return $this->standardizeData($fileContent);
    }

    private function readFile(): array
    {
        $file = fopen(self::FILE_PATH, 'r');

        $returnArray = [];
        if ($file !== false) {
            $fields = array_flip(fgetcsv($file));
            while (($data = fgetcsv($file, 0, ',')) !== FALSE) {
                $returnArray[$data[$fields['_key']]] = [
                    'name'    => $data[$fields['name']],
                    'temp'    => $data[$fields['temp']],
                    'country' => $data[$fields['country']],
                ];
            }
            fclose($file);
        }

        return $returnArray;
    }

    private function standardizeData(array $weatherInformations): array
    {
        $finalData = [];

        foreach ($weatherInformations as $city => $weather) {
            $finalData[$city] = [
                'name' => $weather['name'],
                'temp' => round(floatval($weather['temp']), 2)
            ];
        }

        return $finalData;
    }
}