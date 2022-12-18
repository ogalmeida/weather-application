<?php

namespace App\Repositories\Contract;

use App\Entity\Prediction;

interface WeatherDataSourceRepositoryInterface
{
    public function getPredictionByCity(string $city): Prediction;
}
