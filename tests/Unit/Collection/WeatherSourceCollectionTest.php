<?php

namespace Tests\Unit\Collection;

use PHPUnit\Framework\TestCase;
use App\Collections\WeatherSources;
use App\Enums\DataSourceEnum;

class WeatherSourceCollectionTest extends TestCase
{
    public function testShouldThrowInvalidArgumentExceptionWhenTypeIsInvalid()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->expectExceptionMessage('Invalid item type, expected App\Enums\DataSourceEnum, given integer');

        new WeatherSources([1, 2, 3]);
    }

    public function testShouldThrowInvalidArgumentExceptionWhenAddingAnInvalidItem()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->expectExceptionMessage('Invalid item type, expected App\Enums\DataSourceEnum, given integer');

        $collection = new WeatherSources([DataSourceEnum::bbc()]);

        $collection->add(1);
    }
}