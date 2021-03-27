<?php

namespace Exponentiles\Engine\Tests;

use Exponentiles\Engine\Grid;
use Exponentiles\Engine\Tile;
use PHPUnit\Framework\TestCase;

class GridTest extends TestCase
{
    public function test_it_can_be_given_a_size()
    {
        $grid = new Grid(
            size: 2
        );

        $this->assertSame(2, $grid->size);
    }

    public function test_it_initializes_empty_cells()
    {
        $grid = new Grid(
            size: 3
        );

        $this->assertEquals(
            [
                [new Tile(0, 0), new Tile(0, 1), new Tile(0, 2)],
                [new Tile(1, 0), new Tile(1, 1), new Tile(1, 2)],
                [new Tile(2, 0), new Tile(2, 1), new Tile(2, 2)],
            ],
            $grid->tiles
        );
    }

    public function test_it_can_get_a_tile()
    {
        $grid = new Grid(size: 2);

        $expected = new Tile(1, 1);
        $grid->tiles[$expected->x][$expected->y] = $expected;

        $this->assertSame(
            $expected,
            $grid->getTile(1, 1)
        );
    }

    public function test_it_can_get_available_cells()
    {
        $grid = new Grid(size: 2);

        $this->assertCount(
            $grid->size * $grid->size,
            $grid->getAvailableCells()
        );
    }

    public function test_it_can_get_random_available_cell()
    {
        $grid = new Grid(size: 2);

        $grid->getTile(0, 0)->value = 2;
        $grid->getTile(1, 0)->value = 2;
        $grid->getTile(0, 1)->value = 2;

        $this->assertEquals(
            new Tile(1, 1),
            $grid->getAvailableCell()
        );
    }
}
