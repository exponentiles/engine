<?php


namespace Exponentiles\Engine;

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


}
