<?php


namespace Exponentiles\Engine;


use Illuminate\Support\Arr;

class Grid
{
    public int $size;

    public array $cells = [];

    public function __construct(int $size)
    {
        $this->size = $size;
    }

    public function initialize(): self
    {
        for ($y = 0; $y < $this->size; $y++) {
            $this->cells[$y] = [];
            for ($x = 0; $x < $this->size; $x++) {
                $this->cells[$y][] = new EmptyTile($x, $y);
            }
        }

        return $this;
    }

    /**
     * @return EmptyTile[]
     */
    public function getAvailableCells(): array
    {
        return array_filter(Arr::flatten($this->cells), function (Tile $cell) {
            return $cell instanceof EmptyTile;
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
