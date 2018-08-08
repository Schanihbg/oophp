<?php
namespace Schanihbg\Dice;

/**
 * A dicehand, consisting of dices.
 */
class DiceHand
{
    /**
    * @var Dice $dices   Array consisting of dices.
    * @var int  $values  Array consisting of last roll of the dices.
    * @var int $score      Score consisting of hand score.
    */
    private $dices = array();
    private $values = array();
    private $score = 0;


    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $dices Number of dices to create, defaults to five.
     */
    public function __construct($dices = 5)
    {
        for ($i = 0; $i < $dices; $i++) {
            array_push($this->dices, new Dice());
            array_push($this->values, $this->dices[$i]->roll());
        }
    }

    /**
     * Roll all dices save their value.
     *
     * @return void.
     */
    public function roll(): void
    {
        foreach ($this->dices as $index => $dice) {
            $this->values[$index] = $dice->roll();
        }
    }

    /**
     * Get values of dices from last roll.
     *
     * @return array with values of the last roll.
     */
    public function values(): array
    {
        return $this->values;
    }

    /**
     * Get the sum of all dices.
     *
     * @return int as the sum of all dices.
     */
    public function sum(): int
    {
        return array_sum($this->values);
    }

    /**
     * Get the average of all dices.
     *
     * @return float as the average of all dices.
     */
    public function average(): int
    {
        return $this->sum()/count($this->values);
    }

    /**
     * Get the score.
     *
     * @return int as the score.
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * Set the score.
     *
     * @return int as the score.
     */
    public function setScore(int $score): void
    {
        $this->score = $score;
    }

    /**
     * Computer plays one round.
     *
     * @return DiceHand as the dicehand object.
     */
    public function computerPlayRound(int $score): DiceHand
    {
        $this->roll();

        if (!in_array(1, $this->values())) {
            $this->setScore($this->sum() + $score);
        }

        return $this;
    }
}
