<?php

namespace Exponentiles\Engine\Tests;

use Exponentiles\Engine\Tile;
use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;

class TileTest extends TestCase
{
    public function test_it_has_position_and_value()
    {
        $tile = new Tile(0, 0, 512);

        $this->assertSame(0, $tile->x);
        $this->assertSame(0, $tile->y);
        $this->assertSame(512, $tile->value);
    }

    public function test_it_has_a_unique_id()
    {
        $expectedId = 'unique-uuid';

        Str::createUuidsUsing(
            fn () => $expectedId
        );

        $this->assertSame(
            $expectedId,
            (new Tile(0, 0))->id
        );
    }

    public function test_it_can_be_empty()
    {
        $tile = new Tile(1, 2, 0);

        $this->assertTrue(
            $tile->isEmpty()
        );

        $tile->value = 1234;

        $this->assertFalse(
            $tile->isEmpty()
        );
    }

    public function test_it_can_be_not_empty()
    {
        $tile = new Tile(1, 2, 2);

        $this->assertTrue(
            $tile->isNotEmpty()
        );

        $tile->value = 0;

        $this->assertFalse(
            $tile->isNotEmpty()
        );
    }

    public function test_it_is_empty_by_default()
    {
        $tile = new Tile(0, 0);

        $this->assertTrue(
            $tile->isEmpty()
        );
    }

    public function test_it_can_serialize_to_array()
    {
        Str::createUuidsUsing(
            fn () => 'tile-id'
        );

        $tile = new Tile(1, 2, 512);

        $this->assertSame(
            [
                'id' => 'tile-id',
                'x' => 1,
                'y' => 2,
                'value' => 512,
            ],
            $tile->serialize()
        );
    }
}
