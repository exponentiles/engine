<?php

namespace Exponentiles\Engine\Tests;

use Exponentiles\Engine\EmptyTile;
use Exponentiles\Engine\Tile;
use PHPUnit\Framework\TestCase;

class EmptyTileTest extends TestCase
{
    public function test_it_is_null_value_of_tile()
    {
        $emptyTile = new EmptyTile(0, 0);

        $this->assertInstanceOf(Tile::class, $emptyTile);
        $this->assertSame(0, $emptyTile->value);
    }
}
