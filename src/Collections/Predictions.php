<?php

namespace App\Collections;

use App\Models\Prediction;

class Predictions implements \Iterator, \Countable
{
    private $predictions;

    public function __construct()
    {
        $this->predictions = [];
    }

    public function add(Prediction $prediction)
    {
        $this->predictions[] = $prediction;
    }

    public function rewind(): void
    {
        reset($this->predictions);
    }
    
    public function current(): Prediction
    {
        return current($this->predictions);
    }

    public function key(): int
    {
        return key($this->predictions);
    }

    public function next(): void
    {
        next($this->predictions);
    }

    public function valid(): bool
    {
        return current($this->predictions) !== false;
    }

    public function count(): int
    {
        return count($this->predictions);
    }
}