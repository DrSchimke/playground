<?php

namespace Sci\Tests\Playground;

use Sci\Playground\ExceptionHandler;
use Sci\Playground\Test2Exception;
use Sci\Playground\Test3Exception;
use Sci\Playground\TestException;

class ExceptionTest extends \PHPUnit_Framework_TestCase
{
    /** @var callable */
    private $handler;

    public function provider()
    {
        return [
            [function () { throw new TestException(); }],
//            [function () { throw new Test2Exception(); }],
//            [function () { throw new Test3Exception(); }],
        ];
    }

    /**
     * @dataProvider provider
     *
     * @param callable $callMe
     */
    public function test(callable $callMe)
    {
        call_user_func($this->handler, $callMe);
    }

    protected function setUp()
    {
        $handlers = [[$this, 'handle1'], [$this, 'handle2'], [$this, 'handle3']];

        $this->handler = $this->createFunction($handlers);
    }

    /**
     * @param $handlers
     *
     * @return callable
     */
    protected function createFunction(array $handlers)
    {
        var_dump(__METHOD__);
        $handler = array_shift($handlers);
        var_dump($handler[1]);

        if ($handlers) {
            return $this->createFunction($handlers);
        } else {
            return function (callable $callMe) use ($handler) {
                if ($handler) {
                    call_user_func($handler, $callMe);
                } else {
                    call_user_func($callMe);
                }
            };
        }
    }

    /**
     * @param callable $callMe
     */
    private function handle1(callable $callMe)
    {
        try {
            $callMe();
        } catch (TestException $e) {
            echo 'Catched TestException' . PHP_EOL;
        }
    }

    /**
     * @param callable $callMe
     */
    private function handle2(callable $callMe)
    {
        try {
            $callMe();
        } catch (Test2Exception $e) {
            echo 'Catched Test2Exception' . PHP_EOL;
        }
    }

    /**
     * @param callable $callMe
     */
    private function handle3(callable $callMe)
    {
        try {
            $callMe();
        } catch (Test3Exception $e) {
            echo 'Catched Test3Exception' . PHP_EOL;
        }
    }
}
