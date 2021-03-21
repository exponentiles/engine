<?php

namespace Exponentiles\Engine\Tests;

use Exponentiles\Engine\GameManager;
use PHPUnit\Framework\TestCase;

class GameManagerTest extends TestCase
{
    /** @test */
    public function it_has_a_default_grid_size()
    {
        $this->assertInstanceOf(
            GameManager::class,
            new GameManager
        );
    }
}
