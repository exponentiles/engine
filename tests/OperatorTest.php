<?php

namespace Exponentiles\Engine\Tests;

use Exponentiles\Engine\Operator;
use PHPUnit\Framework\TestCase;

class OperatorTest extends TestCase
{
    public function test_it_can_slide()
    {
        $this->assertSame(
            [0, 0, 2, 4],
            Operator::slide([2, 0, 4, 0])
        );
    }

    public function test_it_can_combine()
    {
        $this->assertSame(
            [0, 4, 4, 0],
            Operator::combine([2, 2, 4, 0])
        );
    }

    public function test_it_can_move()
    {
        $this->assertSame(
            [0, 0, 4, 4],
            Operator::move([0, 2, 2, 4])
        );

        $this->assertSame(
            [0, 0, 4, 4],
            Operator::move([2, 2, 2, 2])
        );

        $this->assertSame(
            [0, 2, 4, 4],
            Operator::move([2, 4, 2, 2])
        );
    }

    public function test_it_can_rotate_grid()
    {
        $grid = [
            ['a', 'b', 'c'],
            ['d', 'e', 'f'],
            ['g', 'h', 'i'],
        ];

        $this->assertSame(
            [
                ['a', 'd', 'g'],
                ['b', 'e', 'h'],
                ['c', 'f', 'i'],
            ],
            Operator::rotate($grid)
        );
    }
}
