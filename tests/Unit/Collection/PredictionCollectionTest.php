<?php

namespace Tests\Unit\Collection;

use App\Models\Prediction;
use PHPUnit\Framework\TestCase;
use App\Collections\Predictions;

class PredictionCollectionTest extends TestCase
{
    public function testShouldThrowInvalidArgumentExceptionWhenTypeIsInvalid()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->expectExceptionMessage('Invalid item type, expected App\Models\Prediction, given integer');

        new Predictions([1, 2, 3]);
    }

    public function testShouldThrowInvalidArgumentExceptionWhenAddingAnInvalidItem()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->expectExceptionMessage('Invalid item type, expected App\Models\Prediction, given integer');

        $collection = new Predictions([$this->createStub(Prediction::class)]);

        $collection->add(1);
    }
}