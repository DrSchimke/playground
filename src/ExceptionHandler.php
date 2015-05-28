<?php

namespace Sci\Playground;

class ExceptionHandler
{
    public function handle(callable $function)
    {
        call_user_func($function);
    }
}
