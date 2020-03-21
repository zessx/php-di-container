<?php

namespace ZCode\DI;

class Container
{
    private static array $EXCLUDED_TYPES = array(
        'bool', 'int', 'float', 'string',
        'array', 'object', 'iterable', 'resource'
    );

    private array $bindings = [];

    public function set(string $name, callable $factory): void
    {
        $this->bindings[$name] = $factory;
    }

    public function get(string $name)
    {
        if ($this->has($name)) {
            return $this->bindings[$name]($this);
        }

        try {
            $reflection = new \ReflectionClass($name);

            $dependencies = $this->bindDependencies($reflection);

            return $reflection->newInstanceArgs($dependencies);
        } catch (\ReflectionException $e) {
            throw new EntityNotFoundException(sprintf('Entity "%s" was not found in container.', $name));
            return null;
        }
    }

    public function has(string $name): bool
    {
        return array_key_exists($name, $this->bindings);
    }

    private function bindDependencies(\ReflectionClass $reflection): array
    {
        if (!$constructor = $reflection->getConstructor()) {
            return [];
        }

        $parameters = $constructor->getParameters();

        return array_map(function ($parameter) {
            $type = $parameter->getType();
            if (in_array($type->getName(), self::$EXCLUDED_TYPES)) {
                return $parameter;
            }
            return $this->get($type->getName());
        }, $parameters);
    }
}
