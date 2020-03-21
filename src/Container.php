<?php

namespace ZCode\DI;

class Container
{
    private $bindings = [];

    public function set(string $name, callable $factory): void
    {
        $this->bindings[$name] = $factory;
    }

    public function get(string $name)
    {
        if (!$this->has($name)) {
            throw new \Exception('Entry could not be found in the container.');
            return null;
        }

        return $this->bindings[$name]($this);
    }

    public function has(string $name): bool
    {
        return array_key_exists($name, $this->bindings);
    }
}
