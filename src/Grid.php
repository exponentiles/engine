<?php


namespace Exponentiles\Engine;

use Illuminate\Support\Arr;

class Grid
{
    public int $size;

    /** @var array<int, array<int, Tile>> */
    public array $tiles = [];

    public function __construct(int $size)
    {
        $this->size = $size;

        $this->initialize();
    }

    public function getTile(int $x, int $y): Tile
    {
        return $this->tiles[$x][$y];
    }

    /** @return array<int, Tile> */
    public function getAvailableCells(): array
    {
        $tiles = Arr::collapse($this->tiles);

        return array_filter($tiles, [$this, 'isAvailableCell']);
    }

    public function getAvailableCell(): Tile
    {
        return Arr::random(
            $this->getAvailableCells()
        );
    }

    public function isAvailableCell(Tile $tile): bool
    {
        return $this->tiles[$tile->x][$tile->y]->isEmpty();
    }

    public function fromArray(array $values)
    {
        $rotatedTiles = Operator::rotate($this->tiles);

        $rotatedTiles = Arr::collapse($rotatedTiles);

        foreach ($rotatedTiles as $index => $tile) {
            $tile->value = $values[$index];
        }
    }

    public function toArray(): array
    {
        $result = Operator::rotate($this->tiles);

        $result = Arr::pluck($result, '*.value');

        return Arr::collapse($result);
    }

    private function initialize(): void
    {
        for ($x = 0; $x < $this->size; $x++) {
            $this->tiles[$x] = [];
            for ($y = 0; $y < $this->size; $y++) {
                $this->tiles[$x][$y] = new Tile($x, $y);
            }
        }
    }
}
