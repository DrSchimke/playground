<?php

namespace Sci\Playground;

class ExceptionHandler
{
    public function handle(callable $function)
    {
        try {
            call_user_func($function);
        } catch (FooException $e) {
            var_dump('just handled foo exception', $e);
        }
    }
}
