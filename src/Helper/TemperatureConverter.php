<?php

namespace App\Helper;

use App\Collections\PredictionCollection;
use App\Enums\TemperatureScaleEnum;
use App\Exceptions\IncorrectTemperatureException;
use App\Entity\Prediction;

class TemperatureConverter
{
    /**
     * @throws IncorrectTemperatureException
     */
    public static function standardizeValues(
        PredictionCollection $predictions,
        TemperatureScaleEnum $scale
    ): PredictionCollection {

        $output = new PredictionCollection();

        /** @var Prediction $prediction */
        foreach ($predictions as $prediction) {
            switch ($prediction->scale()) {
                case TemperatureScaleEnum::celsius():
                    $convertedValue = static::convertFromCelsius($prediction->temp(), $scale);
                    break;
                case TemperatureScaleEnum::fahrenheit():
                    $convertedValue = static::convertFromFahrenheit($prediction->temp(), $scale);
                    break;
                case TemperatureScaleEnum::kelvin():
                    $convertedValue = static::convertFromKelvin($prediction->temp(), $scale);
                    break;
                default:
                    throw new IncorrectTemperatureException(
                        sprintf(
                            'A escala %s não pode ser convertida para %s',
                            $prediction->scale(),
                            $scale
                        )
                    );
            }

            $output->add(
                Prediction::fromArray([
                    'temp' => $convertedValue,
                    'city' => $prediction->city(),
                    'scale' => $scale,
                ])
            );
        }

        return $output;
    }

    public static function convertFromCelsius(int $value, TemperatureScaleEnum $newScale)
    {
        switch ($newScale) {
            case TemperatureScaleEnum::celsius():
                return $value;
            case TemperatureScaleEnum::fahrenheit():
                return ($value * 9 / 5) + 32;
            case TemperatureScaleEnum::kelvin():
                return $value + 273.15;
        }
    }

    public static function convertFromFahrenheit(int $value, TemperatureScaleEnum $newScale)
    {
        switch ($newScale) {
            case TemperatureScaleEnum::celsius():
                return ($value - 32) * 5 / 9;
            case TemperatureScaleEnum::fahrenheit():
                return $value;
            case TemperatureScaleEnum::kelvin():
                return ($value - 32) * 5 / 9 + 273.15;
        }
    }

    public static function convertFromKelvin(int $value, TemperatureScaleEnum $newScale)
    {
        switch ($newScale) {
            case TemperatureScaleEnum::celsius():
                return $value - 273.15;
            case TemperatureScaleEnum::fahrenheit():
                return ($value - 273.15) * 9 / 5 + 32;
            case TemperatureScaleEnum::kelvin():
                return $value;
        }
    }
}
