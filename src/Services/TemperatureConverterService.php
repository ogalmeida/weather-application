<?php

namespace App\Services;

use App\Models\Predictions;
use App\Exceptions\IncorrectTemperatureException;

class TemperatureConverterService
{
    private $predictions;

    public function __construct(Predictions $predictions)
    {
        $this->predictions = $predictions;   
    }

    public function standardizeValues(string $scale): void 
    {
        if (!self::checkScaleTo($scale)) {
            throw new IncorrectTemperatureException('A escala destino (' . ucfirst($scale) . ') não é válida.');
        }

        foreach ($this->predictions->jsonSerialize() as $prediction) {
            switch ($prediction->getScale()) {
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
                    throw new IncorrectTemperatureException('A escala ' . $prediction->getScale() . ' não pode ser convertida para ' . ucfirst($scale));
            }

            $prediction->setTemp($convertedValue);
            $prediction->setScale($scale);
        }
    }

    private static function checkScaleTo(string $scale): bool
    {
        return in_array(strtolower($scale), ['celsius', 'fahrenheit', 'kelvin']);
    }

    private static function convertFromCelsius(int $value, string $to)
    {
        switch ($to) {
            case 'celsius':
                return $value;
            case 'fahrenheit':
                return ($value * 9/5) + 32;
            case 'kelvin':
                return $value + 273.15;
        }
    }

    private static function convertFromFahrenheit(int $value, string $to)
    {
        switch ($to) {
            case 'celsius':
                return ($value - 32) * 5/9;
            case 'fahrenheit':
                return $value;
            case 'kelvin':
                return ($value - 32) * 5/9 + 273.15;
        }
    }

    private static function convertFromKelvin(int $value, string $to)
    {
        switch ($to) {
            case 'celsius':
                return $value - 273.15;
            case 'fahrenheit':
                return ($value - 273.15) * 9/5 + 32;
            case 'kelvin':
                return $value;
        }
    }
}