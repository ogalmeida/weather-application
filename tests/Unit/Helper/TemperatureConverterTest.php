<?php

namespace Tests\Unit\Helper;

use App\Enums\TemperatureScaleEnum;
use App\Helper\TemperatureConverter;
use PHPUnit\Framework\TestCase;

class TemperatureConverterTest extends TestCase
{
    public function testShouldConvertTemperatureFromCelsiusToFahrenheitCorrectly(): void
    {
        $celsius = 23.0;
        $fahrenheit = 73.4;

        $this->assertEquals(
            $fahrenheit,
            TemperatureConverter::convertFromCelsius(
                $celsius,
                TemperatureScaleEnum::fahrenheit()
            )
        );
    }
}
