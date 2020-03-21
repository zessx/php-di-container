<?php

namespace ZCode\DI\Test;

use PHPUnit\Framework\TestCase;
use ZCode\DI\Container;
use ZCode\DI\Test\Entity\Foo;
use ZCode\DI\Test\Entity\Bar;
use ZCode\DI\Test\Entity\Baz;

class ExplicitDependencyTest extends TestCase
{
    public function testSingleLevelDependency(): void
    {
        $container = new Container();

        $container->set(Baz::class, function (Container $container) {
            return new Baz();
        });

        $this->assertInstanceOf(Baz::class, $container->get(Baz::class));
    }

    public function testMultipleLevelDependency(): void
    {
        $container = new Container();

        $container->set(Foo::class, function (Container $container) {
            return new Foo($container->get(Bar::class));
        });

        $container->set(Bar::class, function (Container $container) {
            return new Bar($container->get(Baz::class));
        });

        $container->set(Baz::class, function (Container $container) {
            return new Baz();
        });

        $instance = $container->get(Foo::class);

        $this->assertInstanceOf(Foo::class, $instance);
        $this->assertInstanceOf(Bar::class, $instance->bar);
        $this->assertInstanceOf(Baz::class, $instance->bar->baz);
    }
}
