<?php

declare(strict_types=1);

namespace Core;

class Validator
{
    public static function validateStriing($input, $min = 1, $max = INF): bool
    {
        $value = htmlspecialchars(trim($input));

        return ((strlen($value) >= $min) && strlen($value) <= $max);

    }
}
