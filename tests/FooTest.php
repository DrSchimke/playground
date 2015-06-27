<?php

namespace Sci\Tests\Playground;

use Sci\Playground\Stream;

class StreamTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $foo = Stream::createFromArray([0, 1, 2, 3, 4])
                ->map(function ($a) { return $a * 2; })
                ->filter(function ($a) { return $a < 5; });

        var_dump($foo);
//        $array = $stream
//            ->map(function ($number) { return $number * $number; })
//            ->filter(function ($square) { return $square > 5; })
//            ->toArray();
    }

    public function test2()
    {
        $a = $this->foo();

        $this->bar($a);
    }

    private function foo()
    {
        for ($i = 0; $i < 10; ++$i) {
            var_dump(__METHOD__ . " " . $i);
            yield $i;
        }
    }

    private function bar(\Traversable $traversable)
    {
        foreach ($traversable as $a => $b) {
            var_dump($a . ' ' . $b);
        }
    }
}
