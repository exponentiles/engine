<?php

namespace Exponentiles\Engine\Tests;

use Exponentiles\Engine\Engine;
use Exponentiles\Engine\Grid;
use Illuminate\Support\Arr;
use PHPUnit\Framework\TestCase;

class EngineTest extends TestCase
{
    public function test_it_can_add_random_tile_to_given_grid()
    {
        $grid = new Grid(size: 2);

        $engine = new Engine();
        $engine->addTileTo($grid);

        $this->assertCount(
            ($grid->size * $grid->size) - 1,
            $grid->getAvailableCells()
        );
    }

    public function test_it_initializes_grid_on_start()
    {
        $grid = new Grid(size: 2);

        (new Engine())->start($grid);

        $this->assertCount(
            ($grid->size * $grid->size),
            Arr::collapse($grid->tiles),
        );
    }

    public function test_it_adds_two_tiles_on_start()
    {
        $grid = new Grid(size: 2);

        $engine = new Engine();
        $engine->start($grid);

        $this->assertCount(
            ($grid->size * $grid->size) - 2,
            $grid->getAvailableCells()
        );
    }
}
