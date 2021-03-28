<?php


namespace Exponentiles\Engine;

use Illuminate\Support\Arr;

class Engine
{
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
            $this->addTileTo();
        }
    }

    public function addTileTo(): self
    {
        $cell = $this->grid->getAvailableCell();
        $value = (random_int(0, 100) < 90) ? 2 : 4;

        // Can I just operate directly on the cell???
        $this->grid->getTile($cell->x, $cell->y)->value = $value;

        return $this;
    }

    public function steer(string $direction): void
    {
        if ($direction === 'EAST' || $direction === 'WEST') {
            $this->grid->tiles = Operator::rotate($this->grid->tiles);
        }

        foreach ($this->grid->tiles as $column) {
            // Pluck tile values to form,
            // an ordered integer array.
            $values = Arr::pluck($column, 'value');

            if ($direction === 'NORTH' || $direction === 'WEST') {
                $values = array_reverse($values);
            }

            // Operate on the plucked values.
            $values = Operator::move($values);

            if ($direction === 'NORTH' || $direction === 'WEST') {
                $values = array_reverse($values);
            }

            // Map moved values to column tiles.
            foreach ($column as $index => $tile) {
                $tile->value = $values[$index];
            }
        }

        if ($direction === 'EAST' || $direction === 'WEST') {
            $this->grid->tiles = Operator::rotate($this->grid->tiles);
        }
    }
}
