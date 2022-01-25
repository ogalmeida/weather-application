<?php

namespace App\Models;

use App\Models\Prediction;

class Predictions implements \Iterator, \Countable, \JsonSerializable
{
    private $predictions;
    private $position;

    public function __construct()
    {
        $this->predictions = [];
        $this->position    = 0;
    }

    public function addPrediction(Prediction $prediction)
    {
        $this->predictions[] = $prediction;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }
    
    public function current(): Prediction
    {
        return $this->predictions[$this->position];
    }

    public function key(): int
    {
        return $this->position;
    }

    public function next(): void
    {
        $this->position += 1;
    }

    public function valid(): bool
    {
        return isset($this->predictions[$this->position]);
    }

    public function count(): int
    {
        return count($this->predictions);
    }

    public function jsonSerialize(): array
    {
        return $this->predictions;
    }
}