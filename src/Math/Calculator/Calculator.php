<?php

namespace Misiyuk\Bundle\MathBundle\Math\Calculator;

use Misiyuk\Bundle\MathBundle\Math\Exceptions\ValidationException;

class Calculator implements CalculatorInterface
{
    /**
     * @throws ValidationException
     */
    public function calc(string $str): float
    {
        $this->validation($str);
        $str = $this->calcOperation($str, '/', function (array $v) {
            return $v[0] / $v[1];
        });
        $str = $this->calcOperation($str, '*', function (array $v) {
            return $v[0] * $v[1];
        });
        $str = $this->calcOperation($str, '-', function (array $v) {
            return $v[0] - $v[1];
        });
        $str = $this->calcOperation($str, '+', 'array_sum');

        return floatval($str);
    }

    /**
     * @throws ValidationException
     */
    public function validation(string $str): void
    {
        if (!preg_match('#^[\-]?\d+(\.\d+)?([\+\-\/\*]\d+(\.\d+)?)*$#', $str)) {
            throw new ValidationException();
        }
    }

    private function calcOperation(string $str, string $operation, callable $func): string
    {
        $pattern = '#[\-]?\d+(\.\d+)?\\'.$operation.'\d+\.?\d*#';
        while (preg_match($pattern, $str)) {
            $str = preg_replace_callback($pattern, function (array $str) use ($operation, $func) {
                $values = array_map(function (string $v) {
                    return floatval($v);
                }, preg_split('#\b\\'.$operation.'#', $str[0]));

                return $func($values);
            }, $str);
        }

        return $str;
    }
}
