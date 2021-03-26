<?php

namespace Exponentiles\Engine\Tests;

use Exponentiles\Engine\Game;
use Exponentiles\Engine\Tile;
use PHPUnit\Framework\TestCase;

class ControlledGameTest extends TestCase
{
    public function test_it_can_move_tiles_north()
    {
        $game = new Game(
            size: 2
        );

        // +---+---+
        // |   |   |
        // +---+---+
        // |   |   |
        // +---+---+
        $game->grid->initialize();

        // +---+---+
        // | 2 |   |
        // +---+---+
        // |   | 2 |
        // +---+---+
        $game->grid->addTile(new Tile(0, 0, 2));
        $game->grid->addTile(new Tile(1, 1, 2));
        $this->assertEquals(
            [
                [new Tile(0, 0, 2), new Tile(1, 0)],
                [new Tile(0, 1),    new Tile(1, 1, 2)],
            ],
            $game->grid->tiles
        );

        $game->move('north');

        $this->assertEquals(
            [
                [new Tile(0, 0, 2), new Tile(1, 0, 2)],
                [new Tile(0, 1),    new Tile(1, 1)],
            ],
            $game->grid->tiles
        );
    }
}
