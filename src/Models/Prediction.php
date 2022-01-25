<?php

namespace App\Models;

class Prediction
{
    private float $temp;
    private string $city;

    public function __construct(float $temp, string $city)
    {
        $this->temp = $temp;
        $this->city = $city;
    }

    public function getTemp(): float
    {
        return $this->temp;
    }

    public function getCity(): string
    {
        return $this->city;
    }
}