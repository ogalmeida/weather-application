<?php

namespace App\Models;

use App\Exceptions\IncorrectDataSourceException;
use App\Repositories\DataSourceRepositoryInterface;

class WeatherSources implements \Countable
{
    private $sources;

    public function __construct()
    {
        $this->sources = [];
    }

    public function setSources(array $sources): void
    {
        if (!count($sources)) {
            throw new IncorrectDataSourceException('Não foi possível encontrar nenhuma fonte de dados.');
        }

        foreach ($sources as $source) {
            $implementations = class_implements($source);
            if (!isset($implementations['App\Repositories\DataSourceRepositoryInterface'])) {
                throw new IncorrectDataSourceException('A fonte de dados informada não é compatível com a Interface App\Repositories\DataSourceRepositoryInterface.');
            }
            
            $this->addSource($source);
        }
    }

    public function getSources(): array
    {
        return $this->sources;
    }

    public function count(): int
    {
        return count($this->sources);
    }

    private function addSource(string $source): void
    {
        $this->sources[] = $source;
    }
}