<?php

namespace Exponentiles\Engine;

class Tile
{
    public function __construct(
        public int $x,
        public int $y,
        public int $value = 0,
    ) {
        // A tile with a value.
    }

    public function isEmpty(): bool
    {
        return $this->value === 0;
    }

    public function isNotEmpty(): bool
    {
        return ! $this->isEmpty();
    }
}
