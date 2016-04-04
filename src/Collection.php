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

    /**
     * @param array $data
     */
    public function __construct(array $data = null)
    {
        $this->data = $data;
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->data);
    }

    /**
     * @param $key
     * @return null
     */
    public function get($key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }
}