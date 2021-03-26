<?php

namespace Exponentiles\Engine;

class Tile
{
    public function __construct(
        public int $x,
        public int $y,
        public int $value,
    ) {
        // A tile with a value.
    }
}
