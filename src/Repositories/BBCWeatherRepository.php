<?php

namespace App\Repositories;

use App\Models\Prediction;
use App\Models\Predictions;
use App\Repositories\DataSourceRepositoryInterface;

class BBCWeatherRepository implements DataSourceRepositoryInterface
{
    private const FILE_PATH = __DIR__ . '/../../data/bbc.xml';
    private $predictions;

    public function __construct(Predictions $predictions)
    {
        $this->predictions = $predictions;
    }

    public function getAllWeatherInformation(string $city): void
    {
        $data = $this->getData();
        
        $prediction = new Prediction($data[$city]['temp'], $data[$city]['name'], 'celsius');

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

        $returnContent = [];
        if ($fileContent !== false) {
            $fileContent    = simplexml_load_string($fileContent);
            $fileContent    = json_encode($fileContent);
            $returnContent  = json_decode($fileContent, true);
        }

        return $returnContent;
    }

    private function standardizeData(array $weatherInformations): array
    {
        $finalData = [];

        foreach ($weatherInformations as $city => $weather) {
            $finalData[$city] = [
                'name' => $weather['name'],
                'temp' => round($weather['temperature'], 2)
            ];
        }

        return $finalData;
    }
}