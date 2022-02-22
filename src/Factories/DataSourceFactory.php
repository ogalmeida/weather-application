<?php

namespace App\Factories;

use App\Enums\DataSourceEnum;
use App\Collections\Predictions;
use App\Repositories\DataSourceRepositoryInterface;

class DataSourceFactory implements DataSourceFactoryInterface
{
    public function create(DataSourceEnum $source, Predictions $predictions): DataSourceRepositoryInterface
    {
        $objSource = $source->getSource();
        return new $objSource($predictions);
    }
}