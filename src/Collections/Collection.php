<?php

namespace App\Collections;

use App\Models\Prediction;
use InvalidArgumentException;

class Collection implements \Iterator, \Countable
{
    protected string $allowedType = '';
    protected array $items;

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(array $items = [])
    {
        if ('' !== $this->allowedType) {
            $this->assertValidTypes($items);
        }

        $this->items = $items;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function add($item)
    {
        if ('' !== $this->allowedType) {
            $this->assertValidType($item);
        }

        $this->items[] = $item;
    }

    public function rewind(): void
    {
        reset($this->items);
    }
    
    public function current()
    {
        return current($this->items);
    }

    public function key(): int
    {
        return key($this->items);
    }

    public function next(): void
    {
        next($this->items);
    }

    public function valid(): bool
    {
        return current($this->items) !== false;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function toArray(): array
    {
        return $this->items;
    }

    public function first()
    {
        return $this->items[0] ?? null;
    }

    /**
     * @throws InvalidArgumentException
     */
    private function assertValidTypes($values): void
    {
        foreach ($values as $value) {
            $this->assertValidType($value);
        }
    }

    /**
     * @throws InvalidArgumentException
     */
    private function assertValidType($value): void
    {
        if ($value instanceof $this->allowedType) {
            return;
        }

        throw new InvalidArgumentException(
            sprintf(
                'Invalid item type, expected %s, given %s',
                $this->allowedType,
                is_object($value) ? get_class($value) : gettype($value)
            )
        );
    }
}