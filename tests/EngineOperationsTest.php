<?php

namespace Exponentiles\Engine\Tests;

use Exponentiles\Engine\Engine;
use PHPUnit\Framework\TestCase;

class EngineOperationsTest extends TestCase
{
    public function test_it_can_steer_north()
    {
        $engine = new Engine();

        $engine->grid->fromArray(
            [
                0, 0, 0, 0,
                0, 0, 2, 0,
                4, 4, 4, 4,
                4, 4, 4, 8,
            ]
        );

        $engine->steer(Engine::DIRECTION_NORTH);

        $this->assertEquals(
            [
                8, 8, 2, 4,
                0, 0, 8, 8,
                0, 0, 0, 0,
                0, 0, 0, 0,
            ],
            $engine->grid->toArray()
        );
    }

    public function test_it_can_steer_south_array()
    {
        $engine = new Engine();

        $engine->grid->fromArray(
            [
                2, 2, 2, 2,
                2, 2, 4, 2,
                4, 2, 2, 4,
                0, 2, 2, 4,
            ]
        );

        $engine->steer(Engine::DIRECTION_SOUTH);

        $this->assertEquals(
            [
                0, 0, 0, 0,
                0, 0, 2, 0,
                4, 4, 4, 4,
                4, 4, 4, 8,
            ],
            $engine->grid->toArray()
        );
    }

    public function test_it_can_steer_east()
    {
        $engine = new Engine();

        $engine->grid->fromArray(
            [
                8, 8, 2, 4,
                0, 0, 8, 8,
                0, 0, 0, 0,
                0, 0, 0, 0,
            ],
        );

        $engine->steer(Engine::DIRECTION_EAST);

        $this->assertEquals(
            [
                0, 16, 2, 4,
                0, 0, 0, 16,
                0, 0, 0, 0,
                0, 0, 0, 0,
            ],
            $engine->grid->toArray()
        );
    }

    public function test_it_can_steer_west()
    {
        $engine = new Engine();

        $engine->grid->fromArray(
            [
                0, 16, 2, 4,
                0, 0, 0, 16,
                0, 0, 0, 0,
                0, 0, 0, 0,
            ],
        );

        $engine->steer(Engine::DIRECTION_WEST);

        $this->assertEquals(
            [
                16, 2, 4, 0,
                16, 0, 0, 0,
                0, 0, 0, 0,
                0, 0, 0, 0,
            ],
            $engine->grid->toArray()
        );
    }
}
