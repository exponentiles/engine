<?php

namespace Exponentiles\Engine\Tests;

use Exponentiles\Engine\Engine;
use Exponentiles\Engine\Grid;
use Exponentiles\Engine\Tile;
use PHPUnit\Framework\TestCase;

class EngineOperationsTest extends TestCase
{
    public function test_it_slides_given_column()
    {
        /*
         * +---+---+---+---+
         * | 2 | 0 | 4 | 0 |
         * +---+---+---+---+
         */
        $result = (new Engine)->slideColumn([
            new Tile(0, 0, 2),
            new Tile(0, 1, 0),
            new Tile(0, 2, 4),
            new Tile(0, 3, 0),
        ]);

        /*
         * +---+---+---+---+
         * | 2 | 4 | 0 | 0 |
         * +---+---+---+---+
         */
        $this->assertEquals(
            [
                new Tile(0, 0, 0),
                new Tile(0, 1, 0),
                new Tile(0, 2, 2),
                new Tile(0, 3, 4),
            ],
            $result
        );
    }

    public function test_it_combines_given_column()
    {
        /*
        * +---+---+---+---+
        * | 2 | 2 | 4 | 0 |
        * +---+---+---+---+
        */
        $result = (new Engine)->combineColumn([
            new Tile(0, 0, 2),
            new Tile(0, 1, 2),
            new Tile(0, 2, 4),
            new Tile(0, 3, 0),
        ]);

        /*
         * +---+---+---+---+
         * | 0 | 4 | 4 | 0 |
         * +---+---+---+---+
         */
        $this->assertEquals(
            [
                new Tile(0, 0, 0),
                new Tile(0, 1, 4),
                new Tile(0, 2, 4),
                new Tile(0, 3, 0),
            ],
            $result
        );
    }

    public function test_it_slides_downwards()
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

        $engine->slide($grid, 'SOUTH');

        /*
         * +---+---+---+---+
         * | 0 | 0 | 0 | 0 |
         * +---+---+---+---+
         * | 0 | 0 | 0 | 0 |
         * +---+---+---+---+
         * | 0 | 0 | 4 | 4 |
         * +---+---+---+---+
         * | 8 | 0 | 4 | 8 |
         * +---+---+---+---+
         */
        $this->assertEquals(
            [
                [new Tile(0, 0, 0), new Tile(0, 1, 0), new Tile(0, 2, 0), new Tile(0, 3, 8)],
                [new Tile(1, 0, 0), new Tile(1, 1, 0), new Tile(1, 2, 0), new Tile(1, 3, 0)],
                [new Tile(2, 0, 0), new Tile(2, 1, 0), new Tile(2, 2, 4), new Tile(2, 3, 4)],
                [new Tile(3, 0, 0), new Tile(3, 1, 0), new Tile(3, 2, 4), new Tile(3, 3, 8)],
            ],
            $grid->tiles
        );
    }
}
