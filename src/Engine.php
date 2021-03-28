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

    /**
     * @param array<int, Tile> $tiles
     * @return array<int, Tile>
     */
    public function combineColumn(array $tiles): array
    {
        $values = Arr::pluck($tiles, 'value');

        // Loop backwards through tile values.
        for ($i = count($values) - 1; $i >= 1; $i--) {
            $current = $values[$i];
            $previous = $values[$i - 1] ?? null;

            if ($current !== $previous) {
                continue;
            }

            // Combine onto current value.
            $values[$i] = $current + $previous;

            // Empty previous value.
            $values[$i - 1] = 0;
        }

        return collect($values)
            ->map(function ($value, $index) use ($tiles) {
                $tiles[$index]->value = $value;

                return $tiles[$index];
            })->toArray();
    }

    public function slide(Grid $grid, string $direction)
    {
        foreach ($grid->tiles as $index => $column) {
            $grid->tiles[$index] = $this->slideColumn($column);
            $grid->tiles[$index] = $this->combineColumn($column);
            $grid->tiles[$index] = $this->slideColumn($column);
        }
    }
}
