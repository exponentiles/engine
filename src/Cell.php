<?php


namespace Exponentiles\Engine;


class Cell
{
    public function __construct(
        public int $x,
        public int $y
    ) {
        // The default tile class
    }
}
