<?php

namespace Tests\Unit\Entity;

use App\Entity\Prediction;
use App\Enums\TemperatureScaleEnum;
use PHPUnit\Framework\TestCase;

class PredictionTest extends TestCase
{
    public function testShouldInstantiateFromArrayCorrectly(): void
    {
        $data = [
            'city' => 'Catalão',
            'temp' => 23.234,
            'scale' => TemperatureScaleEnum::celsius(),
        ];

        $prediction = Prediction::fromArray($data);

        $this->assertInstanceOf(Prediction::class, $prediction);
    }

    public function testShouldReturnToArrayCorrectly(): void
    {
        $data = [
            'city' => 'Catalão',
            'temp' => 23.234,
            'scale' => TemperatureScaleEnum::celsius(),
        ];

        $prediction = Prediction::fromArray($data);

        $this->assertEquals($data, $prediction->toArray());
    }
}
