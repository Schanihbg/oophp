<?php

namespace Schanihbg\Guess;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class GuessTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $guess = new Guess();
        $this->assertInstanceOf("\Schanihbg\Guess\Guess", $guess);

        $res = $guess->tries();
        $exp = 6;
        $this->assertEquals($exp, $res);
    }



    /**
     * Construct object and verify that the object has the expected
     * properties. Use only first argument.
     */
    public function testCreateObjectFirstArgument()
    {
        $guess = new Guess(42);
        $this->assertInstanceOf("\Schanihbg\Guess\Guess", $guess);

        $res = $guess->tries();
        $exp = 6;
        $this->assertEquals($exp, $res);

        $res = $guess->number();
        $exp = 42;
        $this->assertEquals($exp, $res);
    }



    /**
     * Construct object and verify that the object has the expected
     * properties. Use both arguments.
     */
    public function testCreateObjectBothArguments()
    {
        $guess = new Guess(42, 7);
        $this->assertInstanceOf("\Schanihbg\Guess\Guess", $guess);

        $res = $guess->tries();
        $exp = 7;
        $this->assertEquals($exp, $res);

        $res = $guess->number();
        $exp = 42;
        $this->assertEquals($exp, $res);
    }

    /**
     * Make a guess that is too high.
     */
    public function testMakeGuessHighGuess()
    {
        $guess = new Guess(42);
        $this->assertInstanceOf("\Schanihbg\Guess\Guess", $guess);

        $result = $guess->makeGuess(50);
        $this->assertEquals("too high", $result);
    }

    /**
     * Make a guess that is too low.
     */
    public function testMakeGuessLowGuess()
    {
        $guess = new Guess(42);
        $this->assertInstanceOf("\Schanihbg\Guess\Guess", $guess);

        $result = $guess->makeGuess(1);
        $this->assertEquals("too low", $result);
    }

    /**
     * Make a guess that is correct.
     */
    public function testMakeGuessCorrectGuess()
    {
        $guess = new Guess(42);
        $this->assertInstanceOf("\Schanihbg\Guess\Guess", $guess);

        $result = $guess->makeGuess(42);
        $this->assertEquals("correct", $result);
    }
}
