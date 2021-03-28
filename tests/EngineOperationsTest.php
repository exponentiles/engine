<?php

namespace Exponentiles\Engine\Tests;

use Exponentiles\Engine\Engine;
use Exponentiles\Engine\Tile;
use PHPUnit\Framework\TestCase;

class EngineOperationsTest extends TestCase
{
    public function test_it_can_steer_south()
    {
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
        $engine->grid->tiles = [
            [new Tile(0, 0, 2), new Tile(0, 1, 2), new Tile(0, 2, 4), new Tile(0, 3, 0)],
            [new Tile(1, 0, 2), new Tile(1, 1, 2), new Tile(1, 2, 2), new Tile(1, 3, 2)],
            [new Tile(2, 0, 2), new Tile(2, 1, 4), new Tile(2, 2, 2), new Tile(2, 3, 2)],
            [new Tile(3, 0, 2), new Tile(3, 1, 2), new Tile(3, 2, 4), new Tile(3, 3, 4)],
        ];

        $engine->steer('SOUTH');

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
            $engine->grid->tiles
        );
    }

    public function test_it_can_steer_north()
    {
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
        $engine->grid->tiles = [
            [new Tile(0, 0, 2), new Tile(0, 1, 2), new Tile(0, 2, 4), new Tile(0, 3, 0)],
            [new Tile(1, 0, 2), new Tile(1, 1, 2), new Tile(1, 2, 2), new Tile(1, 3, 2)],
            [new Tile(2, 0, 2), new Tile(2, 1, 4), new Tile(2, 2, 2), new Tile(2, 3, 2)],
            [new Tile(3, 0, 2), new Tile(3, 1, 2), new Tile(3, 2, 4), new Tile(3, 3, 4)],
        ];

        $engine->steer('NORTH');

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
            $engine->grid->tiles
        );
    }

    public function test_it_can_steer_east()
    {
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
        $engine->grid->tiles = [
            [new Tile(0, 0, 2), new Tile(0, 1, 2), new Tile(0, 2, 4), new Tile(0, 3, 0)],
            [new Tile(1, 0, 2), new Tile(1, 1, 2), new Tile(1, 2, 2), new Tile(1, 3, 2)],
            [new Tile(2, 0, 2), new Tile(2, 1, 4), new Tile(2, 2, 2), new Tile(2, 3, 2)],
            [new Tile(3, 0, 2), new Tile(3, 1, 2), new Tile(3, 2, 4), new Tile(3, 3, 4)],
        ];

        $engine->steer('EAST');

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
            $engine->grid->tiles
        );
    }

    public function test_it_can_steer_west()
    {
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
        $engine->grid->tiles = [
            [new Tile(0, 0, 2), new Tile(0, 1, 2), new Tile(0, 2, 4), new Tile(0, 3, 0)],
            [new Tile(1, 0, 2), new Tile(1, 1, 2), new Tile(1, 2, 2), new Tile(1, 3, 2)],
            [new Tile(2, 0, 2), new Tile(2, 1, 4), new Tile(2, 2, 2), new Tile(2, 3, 2)],
            [new Tile(3, 0, 2), new Tile(3, 1, 2), new Tile(3, 2, 4), new Tile(3, 3, 4)],
        ];

        $engine->steer('WEST');

        /*
         * +---+---+---+---+
         * | 4 | 4 | 0 | 0 |
         * +---+---+---+---+
         * | 4 | 4 | 2 | 0 |
         * +---+---+---+---+
         * | 4 | 4 | 4 | 0 |
         * +---+---+---+---+
         * | 4 | 4 | 0 | 0 |
         * +---+---+---+---+
         */
        $this->assertEquals(
            [
                [new Tile(0, 0, 4), new Tile(0, 1, 4), new Tile(0, 2, 4), new Tile(0, 3, 4)],
                [new Tile(1, 0, 4), new Tile(1, 1, 4), new Tile(1, 2, 4), new Tile(1, 3, 4)],
                [new Tile(2, 0, 0), new Tile(2, 1, 2), new Tile(2, 2, 4), new Tile(2, 3, 0)],
                [new Tile(3, 0, 0), new Tile(3, 1, 0), new Tile(3, 2, 0), new Tile(3, 3, 0)],
            ],
            $engine->grid->tiles
        );
    }
}
