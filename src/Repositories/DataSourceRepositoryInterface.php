<?php

namespace App\Repositories;

interface DataSourceRepositoryInterface
{
    public function getAllWeatherInformation(string $city): void;
}