<?php

namespace ZCode\DI\Test\Entity;

class Bar
{
    public $baz;

    public function __construct(Baz $baz)
    {
        $this->baz = $baz;
    }
}
