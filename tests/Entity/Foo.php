<?php

namespace ZCode\DI\Test\Entity;

class Foo
{
    public $bar;

    public function __construct(Bar $bar)
    {
        $this->bar = $bar;
    }
}
