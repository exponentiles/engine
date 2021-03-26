<?php

namespace Exponentiles\Engine\Tests;

use Exponentiles\Engine\EmptyTile;
use Exponentiles\Engine\Game;
use Exponentiles\Engine\Grid;
use Exponentiles\Engine\Tile;
use Illuminate\Support\Arr;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function test_it_has_a_grid()
    {
        $game = new Game();

        $this->assertInstanceOf(
            Grid::class,
            $game->grid,
        );
    }

    public function test_it_can_customize_grid_size()
    {
        $game = new Game(
            size: 2
        );

        $this->assertSame(2, $game->grid->size);
    }

    public function test_starting_will_initialize_grid()
    {
        $game = new Game();

        $this->assertEmpty($game->grid->cells);

        $game->start();

        $this->assertCount(
            ($game->size * $game->size),
            Arr::flatten($game->grid->cells),
        );
    }

    public function test_starting_will_add_two_random_tiles()
    {
        $game = new Game(
            size: 2
        );

        $game->start();

        $this->assertCount(
            ($game->size * $game->size) - 2,
            $game->grid->getAvailableCells()
        );
    }
}
