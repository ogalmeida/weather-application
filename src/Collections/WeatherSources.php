<?php

namespace App\Collections;

use App\Enums\DataSourceEnum;
use App\Collections\Collection;

class WeatherSources extends Collection
{
    protected string $allowedType = DataSourceEnum::class;
}