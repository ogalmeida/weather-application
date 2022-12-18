<?php

namespace App\Enums;

use App\Repositories\BBCWeatherRepository;
use App\Repositories\ClimaTempoWeatherRepository;
use App\Repositories\OpenWeatherMapRepository;

class WeatherDataSourceEnum
{
    private $source;

    private const BBC = BBCWeatherRepository::class;
    private const CLIMA_TEMPO = ClimaTempoWeatherRepository::class;
    private const OPEN_WEATHER = OpenWeatherMapRepository::class;

    public function __construct(string $source)
    {
        $this->source = $source;
    }

    public static function bbc(): self
    {
        return new self(static::BBC);
    }

    public static function climaTempo(): self
    {
        return new self(static::CLIMA_TEMPO);
    }

    public static function openWeather(): self
    {
        return new self(static::OPEN_WEATHER);
    }

    public function getSource(): string
    {
        return $this->source;
    }
}
