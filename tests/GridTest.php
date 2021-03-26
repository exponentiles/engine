<?php

namespace Exponentiles\Engine\Tests;

use Exponentiles\Engine\Cell;
use Exponentiles\Engine\Grid;
use Exponentiles\Engine\Tile;
use PHPUnit\Framework\TestCase;

class GridTest extends TestCase
{
    public function test_it_can_be_given_a_size()
    {
        $grid = new Grid(
            size: 4
        );

        $this->assertSame(4, $grid->size);
    }

    public function test_it_has_default_size()
    {
        $grid = new Grid();

        $this->assertSame(4, $grid->size);
    }

    public function test_it_can_initialize_empty_cells()
    {
        $grid = new Grid();

        $this->assertEmpty($grid->cells);

        $grid->initialize();

        $this->assertEquals(
            [
                [new cell(0, 0), new cell(1, 0), new cell(2, 0), new cell(3, 0)],
                [new cell(0, 1), new cell(1, 1), new cell(2, 1), new cell(3, 1)],
                [new cell(0, 2), new cell(1, 2), new cell(2, 2), new cell(3, 2)],
                [new cell(0, 3), new cell(1, 3), new cell(2, 3), new cell(3, 3)],
            ],
            $grid->cells
        );
    }

    public function test_it_can_initialize_empty_cells_for_custom_size()
    {
        $grid = new Grid(
            size: 2
        );

        $grid->initialize();

        $this->assertEquals(
            [
                [new Cell(0, 0), new Cell(1, 0)],
                [new Cell(0, 1), new Cell(1, 1)],
            ],
            $grid->cells
        );
    }

    public function test_it_can_return_available_cells()
    {
        $grid = new Grid;

        $grid->initialize();

        $this->assertCount(
            $grid->size * $grid->size,
            $grid->getAvailableCells()
        );
    }

    public function test_it_can_get_a_tile()
    {
        $grid = new Grid(
            size: 2
        );

        $grid->initialize();

        $this->assertEquals(
            new Cell(1, 1),
            $grid->getTile(1, 1)
        );
    }

    public function test_it_can_add_tile()
    {
        $grid = new Grid(
            size: 2
        );

        $grid->initialize();

        $grid->addTile(
            $expected = new Tile(
                x: 0,
                y: 0,
                value: 2,
            )
        );

        $this->assertEquals(
            [
                [$expected,      new Cell(1, 0)],
                [new Cell(0, 1), new Cell(1, 1)],
            ],
            $grid->cells
        );
    }
}
