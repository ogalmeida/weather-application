<?php

namespace App\Repositories;

use Weather;
use App\Models\Prediction;
use App\Models\Predictions;

class OpenWeatherMapRepository implements DataSourceRepositoryInterface
{
    private const FILE_PATH = __DIR__ . '/../../data/openweathermap.json';
    private $predictions;

    public function __construct(Predictions $predictions)
    {
        $this->predictions = $predictions;
    }

    public function getAllWeatherInformation(string $city): void
    {   
        $data = $this->getData();
        
        $prediction = new Prediction($data[$city]['temp'], $data[$city]['name']);
        $this->predictions->addPrediction($prediction);
    }

    private function getData(): array
    {
        $fileContent = $this->readFile();

        return $this->standardizeData($fileContent);
    }

    private function readFile(): array
    {
        $fileContent = file_get_contents(self::FILE_PATH);

        $decodedFile = [];
        if ($fileContent !== false) {
            $decodedFile = json_decode($fileContent, true);
        }
            
        return $decodedFile;
    }

    private function standardizeData(array $weatherInformations): array
    {
        $finalData = [];

        foreach ($weatherInformations as $city => $weather) {
            $finalData[$city] = [
                'name' => $weather['name'],
                'temp' => round($weather['temperatures']['temp'], 2)
            ];
        }

        return $finalData;
    }
}