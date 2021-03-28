<?php


namespace Exponentiles\Engine;

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

    public function slide(Grid $grid, string $direction)
    {
        ray()->clearScreen();
        foreach ($grid->tiles as $index => $column) {
            // Pluck only values
            $values = collect(data_get($column, '*.value'));

            ray($values)->red();

            // Filter away empty tiles
            $values = $values->filter();

            // Pad with missing zeros
            $values = $values->pad(-$grid->size, 0);

            ray($values)->blue();

            // Update column values
            $values->each(function ($value, $key) use ($column) {
                $column[$key]->value = $value;
            });

            $grid->tiles[$index] = $column;
            ray($values->toArray())->green();
            ray($column)->purple();
        }
    }
}
