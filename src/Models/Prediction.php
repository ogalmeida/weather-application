<?php

namespace App\Models;

use App\Enums\TemperatureScale;

class Prediction
{
    private float $temp;
    private string $city;
    private TemperatureScale $scale;

    public function __construct(float $temp, string $city, TemperatureScale $scale)
    {
        $this->temp = $temp;
        $this->city = $city;
        $this->scale = $scale->getScale();
    }

    public function getTemp(): float
    {
        return $this->temp;
    }

    public function setTemp(float $temp): void
    {
        $this->temp = $temp;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getScale(): TemperatureScale
    {
        return $this->scale;
    }

    public function setScale(TemperatureScale $scale): void
    {
        $this->scale = $scale;
    }
}