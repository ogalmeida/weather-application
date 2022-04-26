<?php

namespace Tests\Unit\Collection;

use App\Collections\Collection;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    public function testShouldInstatiateCollectionCorrectly(): void
    {
        $collection = new Collection([1, 2]);

        $this->assertEquals([1, 2], $collection->toArray());

        $this->assertCount(2, $collection);
    }

    public function testShouldAddItemToEmptyCollectionCorrectly(): void
    {
        $collection = new Collection();

        $collection->add(1);

        $this->assertEquals([1], $collection->toArray());

        $this->assertCount(1, $collection);

        $collection->add(2);

        $this->assertEquals([1, 2], $collection->toArray());

        $this->assertCount(2, $collection);
    }

    public function testShouldAddItemToCollectionCorrectly(): void
    {
        $collection = new Collection([1, 2]);

        $collection->add(3);

        $this->assertEquals([1, 2, 3], $collection->toArray());

        $this->assertCount(3, $collection);
    }

    public function testShouldGetFirstElementFromCollection(): void
    {
        $collection = new Collection([1]);

        $this->assertEquals(1, $collection->first());
    }

    public function testShouldReturnNullWhenCollectionIsEmpty(): void
    {
        $collection = new Collection();

        $this->assertNull($collection->first());
    }
}