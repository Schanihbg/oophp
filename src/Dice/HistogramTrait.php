<?php
namespace Schanihbg\Dice;

/**
 * A trait implementing HistogramInterface.
 */
trait HistogramTrait
{
    /**
     * @var array $serie  The numbers stored in sequence.
     */
    private $dices = array();



    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getHistogramSerie()
    {
        return $this->allTurns;
    }



    /**
     * Get min value for the histogram.
     *
     * @return int with the min value.
     */
    public function getHistogramMin()
    {
        return 1;
    }



    /**
     * Get max value for the histogram.
     *
     * @return int with the max value.
     */
    public function getHistogramMax()
    {
        return max($this->dices);
    }
}
