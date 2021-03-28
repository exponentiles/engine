<?php


namespace Exponentiles\Engine;

use Illuminate\Support\Arr;

class Engine
{
    public function start(Grid $grid)
    {
        $startTiles = 2;

        for ($i = 0; $i < $startTiles; $i++) {
            $this->addTileTo($grid);
        }
    }

    public function addTileTo(Grid $grid): self
    {
        $cell = $grid->getAvailableCell();
        $value = (random_int(0, 100) < 90) ? 2 : 4;


        // Can I just operate directly on the cell???
        $grid->getTile($cell->x, $cell->y)->value = $value;

        return $this;
    }

    public function steer(Grid $grid, string $direction)
    {
        foreach ($grid->tiles as $column) {
            // Pluck tile values to form,
            // an ordered integer array.
            $values = Arr::pluck($column, 'value');

            if ($direction === 'NORTH') {
                $values = array_reverse($values);
            }

            // Operate on the plucked values.
            $values = Operator::move($values);

            if ($direction === 'NORTH') {
                $values = array_reverse($values);
            }

            // Map moved values to column tiles.
            foreach ($column as $index => $tile) {
                $tile->value = $values[$index];
            }
        }
    }
}
