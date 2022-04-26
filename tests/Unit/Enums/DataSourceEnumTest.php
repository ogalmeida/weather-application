<?php

namespace Tests\Unit\Enums;

use App\Enums\DataSourceEnum;
use PHPUnit\Framework\TestCase;
use App\Repositories\BBCWeatherRepository;
use App\Repositories\ClimaTempoWeatherRepository;
use App\Repositories\OpenWeatherMapRepository;

class DataSourceEnumTest extends TestCase
{
    public function testShouldInstantiateCorrectClassForDataSource(): void
    {
        $bbc = DataSourceEnum::bbc();
        $climaTempo = DataSourceEnum::climaTempo();
        $openWeather = DataSourceEnum::openWeather();
        
        $this->assertEquals(BBCWeatherRepository::class, $bbc->getSource());
        $this->assertEquals(ClimaTempoWeatherRepository::class, $climaTempo->getSource());
        $this->assertEquals(OpenWeatherMapRepository::class, $openWeather->getSource());
    }

    public function testShouldNotReturnTheWrongRepositoryDataSourceClass(): void
    {
        $bbc = DataSourceEnum::bbc();
        $climaTempo = DataSourceEnum::climaTempo();
        $openWeather = DataSourceEnum::openWeather();
        
        $this->assertNotEquals(ClimaTempoWeatherRepository::class, $bbc->getSource());
        $this->assertNotEquals(OpenWeatherMapRepository::class, $bbc->getSource());

        $this->assertNotEquals(BBCWeatherRepository::class, $climaTempo->getSource());
        $this->assertNotEquals(OpenWeatherMapRepository::class, $climaTempo->getSource());

        $this->assertNotEquals(BBCWeatherRepository::class, $openWeather->getSource());
        $this->assertNotEquals(ClimaTempoWeatherRepository::class, $openWeather->getSource());
    }
}