<?php

namespace Tests\Unit\Enums;

use App\Enums\WeatherDataSourceEnum;
use PHPUnit\Framework\TestCase;
use App\Repositories\BBCWeatherRepository;
use App\Repositories\ClimaTempoWeatherRepository;
use App\Repositories\OpenWeatherMapRepository;

class WeatherDataSourceEnumTest extends TestCase
{
    public function testShouldInstantiateCorrectClassForDataSource(): void
    {
        $bbc = WeatherDataSourceEnum::bbc();
        $climaTempo = WeatherDataSourceEnum::climaTempo();
        $openWeather = WeatherDataSourceEnum::openWeather();

        $this->assertEquals(BBCWeatherRepository::class, $bbc->getSource());
        $this->assertEquals(ClimaTempoWeatherRepository::class, $climaTempo->getSource());
        $this->assertEquals(OpenWeatherMapRepository::class, $openWeather->getSource());
    }

    public function testShouldNotReturnTheWrongRepositoryDataSourceClass(): void
    {
        $bbc = WeatherDataSourceEnum::bbc();
        $climaTempo = WeatherDataSourceEnum::climaTempo();
        $openWeather = WeatherDataSourceEnum::openWeather();

        $this->assertNotEquals(ClimaTempoWeatherRepository::class, $bbc->getSource());
        $this->assertNotEquals(OpenWeatherMapRepository::class, $bbc->getSource());

        $this->assertNotEquals(BBCWeatherRepository::class, $climaTempo->getSource());
        $this->assertNotEquals(OpenWeatherMapRepository::class, $climaTempo->getSource());

        $this->assertNotEquals(BBCWeatherRepository::class, $openWeather->getSource());
        $this->assertNotEquals(ClimaTempoWeatherRepository::class, $openWeather->getSource());
    }
}
