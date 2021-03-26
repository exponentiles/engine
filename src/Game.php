<?php


namespace Exponentiles\Engine;

use Illuminate\Support\Arr;

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

        $this->addStartTiles();
    }

    private function addStartTiles(): void
    {
        for ($i = 0; $i < 2; $i++) {
            $cell = Arr::random($this->grid->getAvailableCells());

            $this->grid->addTile(
                new Tile($cell->x, $cell->y, 2)
            );
        }
    }

}
