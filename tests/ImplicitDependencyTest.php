<?php

namespace ZCode\DI\Test;

use PHPUnit\Framework\TestCase;
use ZCode\DI\Container;
use ZCode\DI\Test\Entity\Foo;
use ZCode\DI\Test\Entity\Bar;
use ZCode\DI\Test\Entity\Baz;

class ImplicitDependencyTest extends TestCase
{
    public function testSingleLevelDependency(): void
    {
        $container = new Container();

        $this->assertInstanceOf(Baz::class, $container->get(Baz::class));
    }

    public function testMultipleLevelDependency(): void
    {
        $container = new Container();

        $instance = $container->get(Foo::class);

        $this->assertInstanceOf(Foo::class, $instance);
        $this->assertInstanceOf(Bar::class, $instance->bar);
        $this->assertInstanceOf(Baz::class, $instance->bar->baz);
    }
}
