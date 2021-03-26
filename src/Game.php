<?php


namespace Exponentiles\Engine;

class Game
{
    public Grid $grid;

    public function __construct(
        public int $size = 4,
    ) {
        $this->grid = new Grid($this->size);
    }

    public function start(): self
    {
        $this->grid->initialize();

        $startTiles = 2;
        for ($i = 0; $i < $startTiles; $i++) {
            $this->addRandomTile();
        }

        return $this;
    }

    private function addRandomTile(): self
    {
        $cell = $this->grid->getAvailableCell();
        $value = (random_int(0, 100) < 90) ? 2 : 4;

        $this->grid->addTile(
            new Tile($cell->x, $cell->y, $value)
        );

        return $this;
    }

    public function move(string $string)
    {
        foreach ($this->grid->tiles as $row => $tiles) {
            foreach ($tiles as $column => $tile) {
                if ($tile instanceof EmptyTile) {
                    continue;
                }

                $above = $this->grid->getTile($tile->x, $tile->y - 1);

                if ($above instanceof EmptyTile) {
                    $moveTile = clone($tile);
                    $this->grid->tiles[$above->x][$above->y] = $moveTile;
                    $this->grid->tiles[$tile->x][$tile->y] = new EmptyTile($tile->x, $tile->y);
                }
            }
        }
    }
}
