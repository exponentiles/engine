<?php


namespace Exponentiles\Engine;

class EmptyTile extends Tile
{
    public function __construct(
        public int $x,
        public int $y
    ) {
        parent::__construct($x, $y, 0);
    }
}
