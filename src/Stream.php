<?php

namespace Sci\Playground;

class Stream
{
    private $array;

    public static function createFromArray(array $array)
    {
        $result = new static();

        $result->array = $array;

        return $result;
    }

    public static function createFromIterator(\Iterator $a)
    {
    }

    /**
     *
     * @param \Sci\Playground\callable $callable
     * @return self
     */
    public function map(callable $callable)
    {
        return static::createFromArray(array_map($callable, $this->array));
    }

    public function filter(callable $callable)
    {
        return static::createFromArray(array_filter($this->array, $callable));
    }
}
