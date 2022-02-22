<?php

namespace App\Models;

use App\Enums\TemperatureScaleEnum;

class Prediction
{
    private float $temp;
    private string $city;
    private TemperatureScaleEnum $scale;

    public function __construct(float $temp, string $city, TemperatureScaleEnum $scale)
    {
        $this->temp = $temp;
        $this->city = $city;
        $this->scale = $scale;
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

    public function getScale(): TemperatureScaleEnum
    {
        return $this->scale;
    }

    public function setScale(TemperatureScaleEnum $scale): void
    {
        $this->scale = $scale;
    }
}