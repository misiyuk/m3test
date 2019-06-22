<?php

namespace Misiyuk\Bundle\MathBundle\Tests;

use Misiyuk\Bundle\MathBundle\Math\Exceptions\ValidationException;
use Misiyuk\Bundle\MathBundle\Math\Math;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MathTest extends WebTestCase
{
    /**
     * @var Math
     */
    private $math;

    public function __construct()
    {
        parent::__construct();
        self::bootKernel();
        $container = self::$container;
        $this->math = $container->get(Math::class);
    }

    public function testCalculator()
    {
        $result = $this->math->calc('-2+2*28/4-18/2*15+5*158-165');
        $this->assertEquals(502, $result);
    }

    public function testValidation()
    {
        try {
            $this->math->calc('2**2');
            $error = false;
        } catch (ValidationException $e) {
            $error = true;
        }
        $this->assertTrue($error);
    }

    protected static function getKernelClass()
    {
        return TestKernel::class;
    }
}
