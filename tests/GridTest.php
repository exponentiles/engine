<?php

namespace Exponentiles\Engine\Tests;

use Exponentiles\Engine\EmptyTile;
use Exponentiles\Engine\Exceptions\GridException;
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

    public function test_it_can_initialize_empty_cells()
    {
        $grid = new Grid(
            size: 4
        );

        $this->assertEmpty($grid->cells);

        $grid->initialize();

        $this->assertEquals(
            [
                [new EmptyTile(0, 0), new EmptyTile(1, 0), new EmptyTile(2, 0), new EmptyTile(3, 0)],
                [new EmptyTile(0, 1), new EmptyTile(1, 1), new EmptyTile(2, 1), new EmptyTile(3, 1)],
                [new EmptyTile(0, 2), new EmptyTile(1, 2), new EmptyTile(2, 2), new EmptyTile(3, 2)],
                [new EmptyTile(0, 3), new EmptyTile(1, 3), new EmptyTile(2, 3), new EmptyTile(3, 3)],
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
                [new EmptyTile(0, 0), new EmptyTile(1, 0)],
                [new EmptyTile(0, 1), new EmptyTile(1, 1)],
            ],
            $grid->cells
        );
    }

    public function test_it_can_get_available_cells()
    {
        $grid = new Grid(
            size: 4
        );

        $grid->initialize();

        $this->assertCount(
            $grid->size * $grid->size,
            $grid->getAvailableCells()
        );
    }

    public function test_it_can_get_random_available_cell()
    {
        $grid = new Grid(
            size: 2
        );

        $grid->initialize();

        $grid->addTile(new Tile(0, 0, 2));
        $grid->addTile(new Tile(1, 0, 2));
        $grid->addTile(new Tile(0, 1, 2));

        $this->assertEquals(
            new EmptyTile(1, 1),
            $grid->getAvailableCell()
        );
    }

    public function test_it_can_get_a_tile()
    {
        $grid = new Grid(
            size: 2
        );

        $grid->initialize();

        $this->assertEquals(
            new EmptyTile(1, 1),
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
                [$expected,      new EmptyTile(1, 0)],
                [new EmptyTile(0, 1), new EmptyTile(1, 1)],
            ],
            $grid->cells
        );
    }

    public function test_it_throws_exception_if_tile_is_not_empty()
    {
        $grid = new Grid(
            size: 2
        );

        $grid->initialize();

        $grid->addTile($expected = new Tile(
            x: 0,
            y: 0,
            value: 2,
        ));

        $this->expectExceptionObject(
            new GridException('Tile at position not empty.')
        );

        $grid->addTile($expected);
    }
}