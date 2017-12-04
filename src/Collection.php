<?php

namespace Ivoba\Headers;

/**
 * Class Collection
 */
class Collection implements \IteratorAggregate
{
    /**
     * @var array
     */
    private $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->data);
    }

    public function get(string $key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    public function toArray(): array
    {
        return $this->data;
    }
}