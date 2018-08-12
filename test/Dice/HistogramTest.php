<?php

namespace Schanihbg\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class HistogramTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObject()
    {
        $histogram = new Histogram();
        $this->assertInstanceOf("\Schanihbg\Dice\Histogram", $histogram);
    }

    /**
     * Test injectData.
     */
    public function testInjectData()
    {
        $histogram = new Histogram();
        $this->assertInstanceOf("\Schanihbg\Dice\Histogram", $histogram);

        $dicehand = new DiceHand();
        $this->assertInstanceOf("\Schanihbg\Dice\DiceHand", $dicehand);

        $histogram->injectData($dicehand);

        $this->assertInternalType("array", $histogram->getSerie());
    }

    /**
     * Test getAsText.
     */
    public function testGetAsText()
    {
        $histogram = new Histogram();
        $this->assertInstanceOf("\Schanihbg\Dice\Histogram", $histogram);

        $dicehand = new DiceHand();
        $this->assertInstanceOf("\Schanihbg\Dice\DiceHand", $dicehand);

        $histogram->injectData($dicehand);
        $histogram->setSerie(array(0 => 1, 1 => 2, 2 => 3, 3 => 4, 4 => 5, 5 => 6));

        $this->assertInternalType("string", $histogram->getAsText());
    }
}
