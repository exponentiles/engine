<?php

namespace Exponentiles\Engine\Tests;

use Exponentiles\Engine\Game;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    /** @test */
    public function it_has_a_default_grid_size()
    {
        $this->assertInstanceOf(
            Game::class,
            new Game
        );
    }
}
