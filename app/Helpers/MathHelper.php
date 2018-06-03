<?php

namespace App\Helpers;

class MathHelper
{
    /**
     * Truncates decimals of $val with $precision
     *
     * @param float $val variable
     * @param int $precision precision
     * @return float
     */
    public static function truncate(float $val, int $precision = 2)
    {
        $mult = pow(10, $precision);
        return floor($val * $mult) / $mult;
    }


}