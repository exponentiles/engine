<?php

namespace Exponentiles\Engine;

use Illuminate\Support\Str;

class Tile
{
    public string $id;

    public function __construct(
        public int $x,
        public int $y,
        public int $value = 0,
    ) {
        // A tile with a value.
        $this->id = Str::orderedUuid();
    }

    public function isEmpty(): bool
    {
        return $this->value === 0;
    }

    public function isNotEmpty(): bool
    {
        return ! $this->isEmpty();
    }

    public function serialize(): array
    {
        return [
            'id' => $this->id,
            'x' => $this->x,
            'y' => $this->y,
            'value' => $this->value,
        ];
    }
}
