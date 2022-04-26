<?php

namespace Tests\Unit\Enums;

use PHPUnit\Framework\TestCase;
use App\Enums\TemperatureScaleEnum;

class TemperatureScaleEnumTest extends TestCase
{
    public function testShouldInstantiateCorrectClassForDataSource(): void
    {
        $celsius = TemperatureScaleEnum::celsius();
        $kelvin = TemperatureScaleEnum::kelvin();
        $fahrenheit = TemperatureScaleEnum::fahrenheit();
        
        $this->assertEquals('celsius', $celsius->getScale());
        $this->assertEquals('kelvin', $kelvin->getScale());
        $this->assertEquals('fahrenheit', $fahrenheit->getScale());
    }

    public function testShouldNotReturnTheWrongRepositoryDataSourceClass(): void
    {
        $celsius = TemperatureScaleEnum::celsius();
        $kelvin = TemperatureScaleEnum::kelvin();
        $fahrenheit = TemperatureScaleEnum::fahrenheit();
        
        $this->assertNotEquals('kelvin', $celsius->getScale());
        $this->assertNotEquals('fahrenheit', $celsius->getScale());

        $this->assertNotEquals('celsius', $kelvin->getScale());
        $this->assertNotEquals('fahrenheit', $kelvin->getScale());

        $this->assertNotEquals('celsius', $fahrenheit->getScale());
        $this->assertNotEquals('kelvin', $fahrenheit->getScale());
    }
}