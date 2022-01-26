<?php

namespace App\Models;

class Prediction
{
    private float $temp;
    private string $city;
    private string $scale;

    public function __construct(float $temp, string $city, string $scale)
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

    public function getScale(): string
    {
        return $this->scale;
    }

    public function setScale(string $scale): void
    {
        $this->scale = $scale;
    }
}