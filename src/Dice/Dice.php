<?php
namespace Schanihbg\Dice;

/**
 * Dice.
 */
class Dice
{
    /**
     * @var int $value      Value of dice.
     * @var int $lastRoll   Last rolled value of dice.
     */
    private $value;
    private $lastRoll;

    /**
     * Constructor.
     *
     */
    public function __construct()
    {
        $this->value = $this->roll();
    }

    /**
     * Roll a dice between 1 and 6.
     *
     * @return integer as Dice value.
     */
    public function roll(): int
    {
        $this->lastRoll = $this->value;
        $this->value = rand(1, 6);
        return $this->value;
    }

    /**
     * Get value.
     *
     * @return integer as Dice value.
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * Get last roll.
     *
     * @return integer as Last roll.
     */
    public function getLastRoll(): int
    {
        return $this->lastRoll;
    }
}
