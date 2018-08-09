<?php

namespace Schanihbg\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class DiceHandTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObject()
    {
        $dicehand = new DiceHand();
        $this->assertInstanceOf("\Schanihbg\Dice\DiceHand", $dicehand);
    }

    /**
     * Test Values.
     */
    public function testValues()
    {
        $dicehand = new DiceHand();
        $this->assertInstanceOf("\Schanihbg\Dice\DiceHand", $dicehand);

        $this->assertInternalType("array", $dicehand->values());
    }

    /**
     * Test Set Values.
     */
    public function testSetValues()
    {
        $dicehand = new DiceHand();
        $this->assertInstanceOf("\Schanihbg\Dice\DiceHand", $dicehand);
        $dicehand->setValues(array(0 => 6, 1 => 6, 2 => 6, 3 => 6, 4 => 6));
        $this->assertInternalType("array", $dicehand->values());
    }

    /**
     * Test Sum.
     */
    public function testSum()
    {
        $dicehand = new DiceHand();
        $this->assertInstanceOf("\Schanihbg\Dice\DiceHand", $dicehand);

        $this->assertInternalType("int", $dicehand->sum());
    }

    /**
     * Test Average.
     */
    public function testAverage()
    {
        $dicehand = new DiceHand();
        $this->assertInstanceOf("\Schanihbg\Dice\DiceHand", $dicehand);

        $this->assertInternalType("int", $dicehand->average());
    }

    /**
     * Test getScore.
     */
    public function testGetScore()
    {
        $dicehand = new DiceHand();
        $this->assertInstanceOf("\Schanihbg\Dice\DiceHand", $dicehand);

        $this->assertInternalType("int", $dicehand->getScore());
    }

    /**
     * Test setScore.
     */
    public function testSetScore()
    {
        $dicehand = new DiceHand();
        $this->assertInstanceOf("\Schanihbg\Dice\DiceHand", $dicehand);

        $dicehand->setScore(55);

        $this->assertEquals(55, $dicehand->getScore());
        $this->assertInternalType("int", $dicehand->getScore());
    }

    /**
     * Test computerPlayRound with no 1 in values.
     */
    public function testComputerPlayRoundSuccess()
    {
        $dicehand = new DiceHand();
        $this->assertInstanceOf("\Schanihbg\Dice\DiceHand", $dicehand);

        $testArray = array(0 => 6, 1 => 6, 2 => 6, 3 => 6, 4 => 6);
        $this->assertInstanceOf("\Schanihbg\Dice\DiceHand", $dicehand->computerPlayRound(1, "test", $testArray));
    }

    /**
     * Test computerPlayRound with a 1 in values.
     */
    public function testComputerPlayRoundFail()
    {
        $dicehand = new DiceHand();
        $this->assertInstanceOf("\Schanihbg\Dice\DiceHand", $dicehand);

        $testArray = array(0 => 1, 1 => 1, 2 => 1, 3 => 1, 4 => 1);
        $this->assertInstanceOf("\Schanihbg\Dice\DiceHand", $dicehand->computerPlayRound(1, "test", $testArray));
    }
}
