<?php

namespace App\Enums;

class TemperatureScale
{
    private $scale;

    private const KELVIN = 'kelvin';
    private const FAHRENHEIT = 'fharenheit';
    private const CELSIUS = 'celsius';

    public function __construct(string $scale)
    {
        $this->scale = $scale;
    }

    public static function kelvin(): self
    {
        return new self(static::KELVIN);
    }

    public static function fahrenheit(): self
    {
        return new self(static::FAHRENHEIT);
    }

    public static function celsius(): self
    {
        return new self(static::CELSIUS);
    }

    public function getScale(): string
    {
        return $this->scale;
    }
}