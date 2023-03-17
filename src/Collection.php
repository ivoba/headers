<?php

namespace Ivoba\Headers;

/**
 * Class Collection
 */
class Collection implements \IteratorAggregate
{
    public function __construct(private readonly array $data = [])
    {
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->data);
    }

    public function get(string $key)
    {
        return $this->data[$key] ?? null;
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
