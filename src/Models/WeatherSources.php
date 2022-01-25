<?php

namespace App\Models;

use App\Repositories\DataSourceRepositoryInterface;

class WeatherSources
{
    private $sources;

    public function __construct()
    {
        $this->sources = [];
    }

    public function setSources(array $sources): void
    {
        foreach ($sources as $source) {
            $implementations = class_implements($source);
            if (isset($implementations['App\Repositories\DataSourceRepositoryInterface'])) {
                $this->addSource($source);
            }
        }
    }

    public function getSources(): array
    {
        return $this->sources;
    }

    private function addSource(string $source): void
    {
        $this->sources[] = $source;
    }
}