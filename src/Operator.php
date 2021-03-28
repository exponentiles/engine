<?php


namespace Exponentiles\Engine;

class Operator
{
    /**
     * @param array<int, int> $values
     * @return array<int, int>
     */
    public static function slide(array $values): array
    {
        $length = count($values);

        $values = array_filter($values);

        $values = array_pad($values, -$length, 0);

        return $values;
    }

    /**
     * @param array<int, int> $values
     * @return array<int, int>
     */
    public static function combine(array $values): array
    {
        // Loop backwards through tile values.
        for ($i = count($values) - 1; $i >= 1; $i--) {
            $current = $values[$i];
            $previous = $values[$i - 1];

            if ($current !== $previous) {
                continue;
            }

            // Combine onto current value.
            $values[$i] = $current + $previous;

            // Empty previous value.
            $values[$i - 1] = 0;
        }

        return $values;
    }

    /**
     * @param array<int, int> $values
     * @return array<int, int>
     */
    public static function move(array $values): array
    {
        // Combine any value pairs.
        $values = static::combine($values);

        // Shift all values to the side.
        $values = static::slide($values);

        return $values;
    }

    public static function rotate(array $grid): array
    {
        $gridSize = count($grid);
        $gridCopy = $grid;

        for ($i = 0; $i < $gridSize; $i++) {
            for ($j = 0; $j < $gridSize; $j++) {
                $gridCopy[$i][$j] = $grid[$j][$i];
            }
        }

        return $gridCopy;
    }
}
