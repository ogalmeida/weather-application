<?php

namespace App\Collections;

use App\Enums\DataSourceEnum;

class WeatherSources implements \Iterator, \Countable
{
    private $sources;

    public function __construct()
    {
        $this->sources = [];
    }

    public function add(DataSourceEnum $source)
    {
        $this->sources[] = $source;
    }

    public function rewind(): void
    {
        reset($this->sources);
    }
    
    public function current(): DataSourceEnum
    {
        return current($this->sources);
    }

    public function key(): int
    {
        return key($this->sources);
    }

    public function next(): void
    {
        next($this->sources);
    }

    public function valid(): bool
    {
        return current($this->sources) !== false;
    }

    public function count(): int
    {
        return count($this->sources);
    }
}