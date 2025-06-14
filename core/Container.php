<?php

namespace Core;

class Container
{
    private array $instances = [];

    public function set(string $key, callable $resolver): void
    {
        $this->instances[$key] = $resolver;
    }

    public function get(string $key)
    {
        if (!isset($this->instances[$key])) {
            throw new \Exception("No entry found for {$key}");
        }

        return $this->instances[$key]($this);
    }
}
