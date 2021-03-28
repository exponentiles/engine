<?php

namespace Exponentiles\Engine\Tests;

use Exponentiles\Engine\Engine;
use Exponentiles\Engine\Grid;
use PHPUnit\Framework\TestCase;

class EngineTest extends TestCase
{
    public function test_it_has_a_grid()
    {
        $engine = new Engine();

        $this->assertInstanceOf(
            Grid::class,
            $engine->grid,
        );
    }

    public function test_it_can_customize_grid_size()
    {
        $engine = new Engine(
            size: 2
        );

        $this->assertSame(2, $engine->grid->size);
    }

    public function test_it_can_add_random_tile()
    {
        $engine = new Engine();

        $engine->addTile();

        $this->assertCount(
            ($engine->grid->size * $engine->grid->size) - 1,
            $engine->grid->getAvailableCells()
        );
    }

    public function test_it_adds_two_tiles_on_start()
    {
        $engine = new Engine();

        $engine->start();

        $this->assertCount(
            ($engine->grid->size * $engine->grid->size) - 2,
            $engine->grid->getAvailableCells()
        );
    }
}
