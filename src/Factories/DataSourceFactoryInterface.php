<?php

namespace App\Factories;

use App\Enums\DataSourceEnum;
use App\Collections\Predictions;
use App\Repositories\DataSourceRepositoryInterface;

interface DataSourceFactoryInterface
{
    public function create(DataSourceEnum $source, Predictions $predictions): DataSourceRepositoryInterface;
}