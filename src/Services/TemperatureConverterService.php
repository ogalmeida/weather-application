<?php

namespace App\Services;

use App\Enums\TemperatureScaleEnum;
use App\Collections\Predictions;
use App\Exceptions\IncorrectTemperatureException;

class TemperatureConverterService
{
    private Predictions $predictions;

    public function __construct(Predictions $predictions)
    {
        $this->predictions = $predictions;   
    }

    public function standardizeValues(TemperatureScaleEnum $scale): void 
    {
        foreach ($this->predictions as $prediction) {
            switch ($prediction->getScale()->getScale()) {
                case 'celsius':
                    $convertedValue = self::convertFromCelsius($prediction->getTemp(), $scale);
                    break;
                case 'fahrenheit':
                    $convertedValue = self::convertFromFahrenheit($prediction->getTemp(), $scale);
                    break;
                case 'kelvin':
                    $convertedValue = self::convertFromKelvin($prediction->getTemp(), $scale);
                    break;
                default:
                    throw new IncorrectTemperatureException('A escala ' . $prediction->getScale()->getScale() . ' não pode ser convertida para ' . ucfirst($scale->getScale()));
            }

            $prediction->setTemp($convertedValue);
            $prediction->setScale($scale);
        }
    }

    private static function convertFromCelsius(int $value, TemperatureScaleEnum $to)
    {
        switch ($to->getScale()) {
            case 'celsius':
                return $value;
            case 'fahrenheit':
                return ($value * 9/5) + 32;
            case 'kelvin':
                return $value + 273.15;
        }
    }

    private static function convertFromFahrenheit(int $value, TemperatureScaleEnum $to)
    {
        switch ($to->getScale()) {
            case 'celsius':
                return ($value - 32) * 5/9;
            case 'fahrenheit':
                return $value;
            case 'kelvin':
                return ($value - 32) * 5/9 + 273.15;
        }
    }

    private static function convertFromKelvin(int $value, TemperatureScaleEnum $to)
    {
        switch ($to->getScale()) {
            case 'celsius':
                return $value - 273.15;
            case 'fahrenheit':
                return ($value - 273.15) * 9/5 + 32;
            case 'kelvin':
                return $value;
        }
    }
}