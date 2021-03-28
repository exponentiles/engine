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

    /**
     * @param array<int, Tile> $tiles
     * @return array<int, Tile>
     */
    public function slideColumn(array $tiles): array
    {
        // pluck only values.
        return collect($tiles)->pluck('value')
            // Filter away empty tiles.
            ->filter()
            // Pad with missing zeros.
            ->pad(-count($tiles), 0)
            // Update column values.
            ->map(function ($value, $index) use ($tiles) {
                // TODO: Implement "setValue(): self" on Tile.
                $tiles[$index]->value = $value;

                return $tiles[$index];
            })->toArray();
    }

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
