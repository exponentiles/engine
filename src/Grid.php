<?php


namespace Exponentiles\Engine;

use Exponentiles\Engine\Exceptions\GridException;
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
        $cells = Arr::collapse($this->cells);

        return array_filter($cells, function ($tile) {
            return $tile instanceof EmptyTile;
        });
    }

    public function getTile(int $x, int $y)
    {
        return $this->cells[$y][$x];
    }

    public function addTile(Tile $tile)
    {
        if (! $this->cells[$tile->y][$tile->x] instanceof EmptyTile) {
            throw new GridException('Tile at position not empty.');
        }

        $this->cells[$tile->y][$tile->x] = $tile;
    }

    public function getAvailableCell(): Tile
    {
        return Arr::random(
            $this->getAvailableCells()
        );
    }
}
