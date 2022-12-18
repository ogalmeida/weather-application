<?php

namespace App\Entity;

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

    public function temp(): float
    {
        return $this->temp;
    }

    public function city(): string
    {
        return $this->city;
    }

    public function scale(): TemperatureScaleEnum
    {
        return $this->scale;
    }

    public static function fromArray(array $data): static
    {
        return new static(
            $data['temp'],
            $data['city'],
            $data['scale'],
        );
    }

    public function toArray(): array
    {
        return [
            'temp' => $this->temp,
            'city' => $this->city,
            'scale' => $this->scale,
        ];
    }
}
