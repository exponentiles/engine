<?php

namespace Exponentiles\Engine\Tests;

use Exponentiles\Engine\Cell;
use PHPUnit\Framework\TestCase;

class CellTest extends TestCase
{
    public function test_it_has_position()
    {
        $tile = new Cell(123, 456);

        $this->assertSame(123, $tile->x);
        $this->assertSame(456, $tile->y);
    }
}
