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
                if ($tile->isEmpty()) {
                    continue;
                }

                $above = $this->grid->getTile($tile->x, $tile->y - 1);

                if ($above->isEmpty()) {
                }
            }
        }
    }
}
