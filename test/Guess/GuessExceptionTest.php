<?php
namespace Schanihbg\Guess;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class GuessExceptionTest extends TestCase
{
    /**
     * Make a guess that throws exception.
     */
    public function testMakeGuessErrorGuess()
    {
        $guess = new Guess(42);
        $this->assertInstanceOf("\Schanihbg\Guess\Guess", $guess);

        $this->expectException("\Schanihbg\Guess\GuessException");
        $result = $guess->makeGuess(420);
        $this->assertEquals("Your guess is out of bounds.", $result);
    }
}
