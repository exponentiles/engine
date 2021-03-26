<?php


namespace Exponentiles\Engine;

use Exponentiles\Engine\Exceptions\GridException;
use Illuminate\Support\Arr;

class Grid
{
    public int $size;

    /** @var array<int, array<int, Tile>> */
    public array $tiles = [];

    public function __construct(int $size)
    {
        $this->size = $size;
    }

    public function initialize(): self
    {
        for ($y = 0; $y < $this->size; $y++) {
            $this->tiles[$y] = [];
            for ($x = 0; $x < $this->size; $x++) {
                $this->tiles[$y][] = new Tile($x, $y);
            }
        }

        return $this;
    }

    /**
     * @return Tile[]
     */
    public function getAvailableCells(): array
    {
        $tiles = Arr::collapse($this->tiles);

        return array_filter($tiles, [$this, 'isAvailableCell']);
    }

    public function getTile(int $x, int $y)
    {
        return $this->tiles[$y][$x] ?? null;
    }

    public function addTile(Tile $tile)
    {
        if (! $this->isAvailableCell($tile)) {
            throw new GridException('Tile at position not empty.');
        }

        $this->tiles[$tile->y][$tile->x] = $tile;
    }

    public function isAvailableCell(Tile $tile): bool
    {
        return $this->tiles[$tile->y][$tile->x]->isEmpty();
    }

    public function getAvailableCell(): Tile
    {
        return Arr::random(
            $this->getAvailableCells()
        );
    }
}
