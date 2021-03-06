<?php

namespace ZCode\DI\Test;

use PHPUnit\Framework\TestCase;
use ZCode\DI\Container;

class ContainerTest extends TestCase
{
    public function testGet(): void
    {
        $container = new Container();

        $container->set('foo', function (Container $container) {
            return new \stdClass();
        });

        $this->assertInstanceOf(\stdClass::class, $container->get('foo'));
    }

    public function testHas(): void
    {
        $container = new Container();

        $container->set('foo', function (Container $container) {
            return new \stdClass();
        });

        $this->assertTrue($container->has('foo'));
        $this->assertFalse($container->has('bar'));
    }
}
