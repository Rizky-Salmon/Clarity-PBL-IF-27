<?php

namespace App;

class Calculator
{
    public function add($a, $b)
    {
        return $a + $b;
    }

    public function divide($a, $b)
    {
        if ($b == 0) {
            throw new \InvalidArgumentException("Divider cannot be zero.");
        }
        return $a / $b;
    }
}
