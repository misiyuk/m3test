<?php

namespace Misiyuk\Bundle\MathBundle\Math\Calculator;

interface CalculatorInterface
{
    public function calc(string $str): float;

    public function validation(string $str): void;
}
