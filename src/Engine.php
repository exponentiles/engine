<?php


namespace Exponentiles\Engine;

use Illuminate\Support\Arr;

class Engine
{
    public const DIRECTION_NORTH = 'NORTH';
    public const DIRECTION_SOUTH = 'SOUTH';
    public const DIRECTION_EAST = 'EAST';
    public const DIRECTION_WEST = 'WEST';

    public Grid $grid;

    public function __construct(
        public int $size = 4
    ) {
        $this->grid = new Grid($this->size);
    }

    public function start(): void
    {
        $startTiles = 2;

        for ($i = 0; $i < $startTiles; $i++) {
            $this->addTile();
        }
    }

    public function addTile(): void
    {
        $cell = $this->grid->getAvailableCell();
        $value = (random_int(0, 100) < 90) ? 2 : 4;

        // Can I just operate directly on the cell???
        $this->grid->getTile($cell->x, $cell->y)->value = $value;
    }

    public function steer(string $direction): self
    {
        if ($this->requiresRotation($direction)) {
            $this->grid->tiles = Operator::rotate($this->grid->tiles);
        }

        foreach ($this->grid->tiles as $column) {
            // Pluck tile values to form,
            // an ordered integer array.
            $values = Arr::pluck($column, 'value');

            if ($this->requiresFlip($direction)) {
                $values = array_reverse($values);
            }

            // Operate on the plucked values.
            $values = Operator::move($values);

            if ($this->requiresFlip($direction)) {
                $values = array_reverse($values);
            }

            // Map moved values to column tiles.
            foreach ($column as $index => $tile) {
                $tile->value = $values[$index];
            }
        }

        if ($this->requiresRotation($direction)) {
            $this->grid->tiles = Operator::rotate($this->grid->tiles);
        }

        return $this;
    }

    private function requiresRotation(string $direction): bool
    {
        return in_array($direction, [
            self::DIRECTION_EAST,
            self::DIRECTION_WEST,
        ]);
    }

    private function requiresFlip(string $direction): bool
    {
        return in_array($direction, [
            self::DIRECTION_NORTH,
            self::DIRECTION_WEST,
        ]);
    }
}
