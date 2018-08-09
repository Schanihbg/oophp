<?php

namespace Schanihbg\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class DiceTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObject()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Schanihbg\Dice\Dice", $dice);
    }

    /**
     * Test getValue.
     */
    public function testGetValue()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Schanihbg\Dice\Dice", $dice);

        $this->assertInternalType("int", $dice->getValue());
    }

    /**
     * Test getLastRoll.
     */
    public function testLastRoll()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Schanihbg\Dice\Dice", $dice);
        $dice->roll();

        $this->assertInternalType("int", $dice->getLastRoll());
    }
}
