<?php

namespace App\Repositories;

interface DataSourceRepositoryInterface
{
    public function fetchWeatherInformation(string $city): void;
}