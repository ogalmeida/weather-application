<?php

namespace App\Factories;

use App\Enums\WeatherDataSourceEnum;
use App\Repositories\Contract\WeatherDataSourceRepositoryInterface;

class WeatherDataSourceFactory
{
    public static function create(WeatherDataSourceEnum $source): WeatherDataSourceRepositoryInterface
    {
        $repository = $source->getSource();
        return new $repository;
    }
}
