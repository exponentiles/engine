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

    public function start()
    {
        $this->grid->initialize();

        $startTiles = 2;
        for ($i = 0; $i < $startTiles; $i++) {
            $this->addRandomTile();
        }
    }

    public function addRandomTile(): void
    {
        $cell = $this->grid->getAvailableCell();
        $value = (random_int(0, 100) < 90) ? 2 : 4;

        $this->grid->addTile(
            new Tile($cell->x, $cell->y, $value)
        );
    }
}
