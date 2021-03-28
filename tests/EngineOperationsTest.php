<?php

namespace Exponentiles\Engine\Tests;

use Exponentiles\Engine\Engine;
use Exponentiles\Engine\Grid;
use Exponentiles\Engine\Tile;
use PHPUnit\Framework\TestCase;

class EngineOperationsTest extends TestCase
{
    public function test_it_can_steer_south()
    {
        $grid = new Grid(size: 4);
        $engine = new Engine();

        /*
         * +---+---+---+---+
         * | 2 | 2 | 2 | 2 |
         * +---+---+---+---+
         * | 2 | 2 | 4 | 2 |
         * +---+---+---+---+
         * | 4 | 2 | 2 | 4 |
         * +---+---+---+---+
         * | 0 | 2 | 2 | 4 |
         * +---+---+---+---+
         */
        $grid->tiles = [
            [new Tile(0, 0, 2), new Tile(0, 1, 2), new Tile(0, 2, 4), new Tile(0, 3, 0)],
            [new Tile(1, 0, 2), new Tile(1, 1, 2), new Tile(1, 2, 2), new Tile(1, 3, 2)],
            [new Tile(2, 0, 2), new Tile(2, 1, 4), new Tile(2, 2, 2), new Tile(2, 3, 2)],
            [new Tile(3, 0, 2), new Tile(3, 1, 2), new Tile(3, 2, 4), new Tile(3, 3, 4)],
        ];

        $engine->steer($grid, 'SOUTH');

        /*
         * +---+---+---+---+
         * | 0 | 0 | 0 | 0 |
         * +---+---+---+---+
         * | 0 | 0 | 2 | 0 |
         * +---+---+---+---+
         * | 4 | 4 | 4 | 4 |
         * +---+---+---+---+
         * | 4 | 4 | 4 | 8 |
         * +---+---+---+---+
         */
        $this->assertEquals(
            [
                [new Tile(0, 0, 0), new Tile(0, 1, 0), new Tile(0, 2, 4), new Tile(0, 3, 4)],
                [new Tile(1, 0, 0), new Tile(1, 1, 0), new Tile(1, 2, 4), new Tile(1, 3, 4)],
                [new Tile(2, 0, 0), new Tile(2, 1, 2), new Tile(2, 2, 4), new Tile(2, 3, 4)],
                [new Tile(3, 0, 0), new Tile(3, 1, 0), new Tile(3, 2, 4), new Tile(3, 3, 8)],
            ],
            $grid->tiles
        );
    }

    public function test_it_can_steer_north()
    {
        $grid = new Grid(size: 4);
        $engine = new Engine();

        /*
         * +---+---+---+---+
         * | 2 | 2 | 2 | 2 |
         * +---+---+---+---+
         * | 2 | 2 | 4 | 2 |
         * +---+---+---+---+
         * | 4 | 2 | 2 | 4 |
         * +---+---+---+---+
         * | 0 | 2 | 2 | 4 |
         * +---+---+---+---+
         */
        $grid->tiles = [
            [new Tile(0, 0, 2), new Tile(0, 1, 2), new Tile(0, 2, 4), new Tile(0, 3, 0)],
            [new Tile(1, 0, 2), new Tile(1, 1, 2), new Tile(1, 2, 2), new Tile(1, 3, 2)],
            [new Tile(2, 0, 2), new Tile(2, 1, 4), new Tile(2, 2, 2), new Tile(2, 3, 2)],
            [new Tile(3, 0, 2), new Tile(3, 1, 2), new Tile(3, 2, 4), new Tile(3, 3, 4)],
        ];

        $engine->steer($grid, 'NORTH');

        /*
         * +---+---+---+---+
         * | 4 | 4 | 2 | 4 |
         * +---+---+---+---+
         * | 4 | 4 | 4 | 8 |
         * +---+---+---+---+
         * | 0 | 0 | 4 | 0 |
         * +---+---+---+---+
         * | 0 | 0 | 0 | 0 |
         * +---+---+---+---+
         */
        $this->assertEquals(
            [
                [new Tile(0, 0, 4), new Tile(0, 1, 4), new Tile(0, 2, 0), new Tile(0, 3, 0)],
                [new Tile(1, 0, 4), new Tile(1, 1, 4), new Tile(1, 2, 0), new Tile(1, 3, 0)],
                [new Tile(2, 0, 2), new Tile(2, 1, 4), new Tile(2, 2, 4), new Tile(2, 3, 0)],
                [new Tile(3, 0, 4), new Tile(3, 1, 8), new Tile(3, 2, 0), new Tile(3, 3, 0)],
            ],
            $grid->tiles
        );
    }

    public function test_it_can_steer_east()
    {
        $grid = new Grid(size: 4);
        $engine = new Engine();

        /*
         * +---+---+---+---+
         * | 2 | 2 | 2 | 2 |
         * +---+---+---+---+
         * | 2 | 2 | 4 | 2 |
         * +---+---+---+---+
         * | 4 | 2 | 2 | 4 |
         * +---+---+---+---+
         * | 0 | 2 | 2 | 4 |
         * +---+---+---+---+
         */
        $grid->tiles = [
            [new Tile(0, 0, 2), new Tile(0, 1, 2), new Tile(0, 2, 4), new Tile(0, 3, 0)],
            [new Tile(1, 0, 2), new Tile(1, 1, 2), new Tile(1, 2, 2), new Tile(1, 3, 2)],
            [new Tile(2, 0, 2), new Tile(2, 1, 4), new Tile(2, 2, 2), new Tile(2, 3, 2)],
            [new Tile(3, 0, 2), new Tile(3, 1, 2), new Tile(3, 2, 4), new Tile(3, 3, 4)],
        ];

        $engine->steer($grid, 'EAST');

        /*
         * +---+---+---+---+
         * | 0 | 0 | 4 | 4 |
         * +---+---+---+---+
         * | 0 | 4 | 4 | 2 |
         * +---+---+---+---+
         * | 0 | 4 | 4 | 4 |
         * +---+---+---+---+
         * | 0 | 0 | 4 | 4 |
         * +---+---+---+---+
         */
        $this->assertEquals(
            [
                [new Tile(0, 0, 0), new Tile(0, 1, 0), new Tile(0, 2, 0), new Tile(0, 3, 0)],
                [new Tile(1, 0, 0), new Tile(1, 1, 4), new Tile(1, 2, 4), new Tile(1, 3, 0)],
                [new Tile(2, 0, 4), new Tile(2, 1, 4), new Tile(2, 2, 4), new Tile(2, 3, 4)],
                [new Tile(3, 0, 4), new Tile(3, 1, 2), new Tile(3, 2, 4), new Tile(3, 3, 4)],
            ],
            $grid->tiles
        );
    }
}
