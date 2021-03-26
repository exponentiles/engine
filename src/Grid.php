<?php


namespace Exponentiles\Engine;


use Illuminate\Support\Arr;

class Grid
{
    public int $size;

    public array $cells = [];

    public function __construct(int $size = 4)
    {
        $this->size = $size;
    }

    public function initialize(): self
    {
        for ($y = 0; $y < $this->size; $y++) {
            $this->cells[$y] = [];
            for ($x = 0; $x < $this->size; $x++) {
                $this->cells[$y][] = new Cell($x, $y);
            }
        }

        return $this;
    }

    /**
     * @return Cell[]
     */
    public function getAvailableCells(): array
    {
        return array_filter(Arr::flatten($this->cells), function (Cell $cell) {
            return $cell instanceof Cell;
        });
    }

    public function getTile(int $x, int $y)
    {
        return $this->cells[$x][$y];
    }

    public function addTile(Tile $tile)
    {
        $this->cells[$tile->x][$tile->y] = $tile;
    }
}
