<?php

namespace Exponentiles\Engine\Tests;

use Exponentiles\Engine\Engine;
use Exponentiles\Engine\Grid;
use Exponentiles\Engine\Tile;
use Illuminate\Support\Arr;
use PHPUnit\Framework\TestCase;

class EngineSlideTest extends TestCase
{
    public function test_it_slides_down()
    {
        $grid = new Grid(size: 3);
        $engine = new Engine();

        /*
         * +---+---+---+
         * | 2 | 0 | 0 |
         * +---+---+---+
         * | 4 | 2 | 0 |
         * +---+---+---+
         * | 0 | 0 | 2 |
         * +---+---+---+
         */
        $grid->getTile(0, 0)->value = 2;
        $grid->getTile(0, 1)->value = 4;
        $grid->getTile(1, 1)->value = 2;
        $grid->getTile(2, 2)->value = 2;

        $engine->slide($grid, 'SOUTH');

        /*
         * +---+---+---+
         * | 0 | 0 | 0 |
         * +---+---+---+
         * | 2 | 0 | 0 |
         * +---+---+---+
         * | 4 | 2 | 2 |
         * +---+---+---+
         */
        $this->assertEquals(
            [
                [new Tile(0, 0, 0), new Tile(0, 1, 2), new Tile(0, 2, 4)],
                [new Tile(1, 0, 0), new Tile(1, 1, 0), new Tile(1, 2, 2)],
                [new Tile(2, 0, 0), new Tile(2, 1, 0), new Tile(2, 2, 2)],
            ],
            $grid->tiles
        );
    }

}
