<?php

namespace App\Repositories;

use App\Enums\TemperatureScaleEnum;
use Weather;
use App\Models\Prediction;
use App\Collections\Predictions;

class OpenWeatherMapRepository implements DataSourceRepositoryInterface
{
    private const FILE_PATH = __DIR__ . '/../../data/openweathermap.json';
    private $predictions;

    public function __construct(Predictions $predictions)
    {
        $this->predictions = $predictions;
    }

    public function fetchWeatherInformation(string $city): void
    {   
        $data = $this->getData();
        
        $prediction = new Prediction($data[$city]['temp'], $data[$city]['name'], TemperatureScaleEnum::kelvin());
        $this->predictions->add($prediction);
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