<?php

namespace Exponentiles\Engine\Tests;

use Exponentiles\Engine\Engine;
use Exponentiles\Engine\Grid;
use Exponentiles\Engine\Tile;
use Illuminate\Support\Arr;
use PHPUnit\Framework\TestCase;

class EngineOperationsTest extends TestCase
{
    public function test_it_slides_downwards()
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

    public function test_it_combines_downwards()
    {
        $grid = new Grid(size: 4);
        $engine = new Engine();

        /*
         * +---+---+---+---+
         * | 4 | 0 | 2 | 2 |
         * +---+---+---+---+
         * | 0 | 0 | 2 | 2 |
         * +---+---+---+---+
         * | 4 | 0 | 2 | 4 |
         * +---+---+---+---+
         * | 0 | 0 | 2 | 4 |
         * +---+---+---+---+
         */
        $grid->tiles = [
            [new Tile(0, 0, 4), new Tile(0, 1, 0), new Tile(0, 2, 4), new Tile(0, 3, 0)],
            [new Tile(1, 0, 0), new Tile(1, 1, 0), new Tile(1, 2, 0), new Tile(1, 3, 0)],
            [new Tile(2, 0, 2), new Tile(2, 1, 2), new Tile(2, 2, 2), new Tile(2, 3, 2)],
            [new Tile(3, 0, 2), new Tile(3, 1, 2), new Tile(3, 2, 4), new Tile(3, 3, 4)],
        ];

        $engine->combine($grid, 'SOUTH');

        /*
         * +---+---+---+---+
         * | 4 | 0 | 0 | 0 |
         * +---+---+---+---+
         * | 0 | 0 | 4 | 4 |
         * +---+---+---+---+
         * | 4 | 0 | 0 | 0 |
         * +---+---+---+---+
         * | 0 | 0 | 4 | 8 |
         * +---+---+---+---+
         */
        $this->assertEquals(
            [
                [new Tile(0, 0, 4), new Tile(0, 1, 0), new Tile(0, 2, 4), new Tile(0, 3, 0)],
                [new Tile(1, 0, 0), new Tile(1, 1, 0), new Tile(1, 2, 0), new Tile(1, 3, 0)],
                [new Tile(2, 0, 0), new Tile(2, 1, 4), new Tile(2, 2, 0), new Tile(2, 3, 4)],
                [new Tile(3, 0, 0), new Tile(3, 1, 4), new Tile(3, 2, 0), new Tile(3, 3, 8)],
            ],
            $grid->tiles
        );
    }
}
