<?php
namespace Schanihbg\Dice;

/**
 * Generating histogram data.
 */
class Histogram
{
    /**
     * @var array $serie  The numbers stored in sequence.
     * @var int   $min    The lowest possible number.
     * @var int   $max    The highest possible number.
     */
    private $serie = [];
    private $min;
    private $max;



    /**
     * Inject the object to use as base for the histogram data.
     *
     * @param HistogramInterface $object The object holding the serie.
     *
     * @return void.
     */
    public function injectData(HistogramInterface $object): void
    {
        $this->serie = $object->getHistogramSerie();
        $this->min   = $object->getHistogramMin();
        $this->max   = $object->getHistogramMax();
    }



    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getSerie(): array
    {
        return $this->serie;
    }

    /**
     * Set the serie.
     *
     * @return void.
     */
    public function setSerie(array $serie): void
    {
        $this->serie = $serie;
    }

    /**
     * Build the histogram
     * Sorting the values into correct array.
     *
     * @param int $min The lowest possible integer number.
     * @param int $max The highest possible integer number.
     *
     * @return array containing the result.
     */
    public function buildHistogram(): array
    {
        $dice1 = array();
        $dice2 = array();
        $dice3 = array();
        $dice4 = array();
        $dice5 = array();
        $dice6 = array();

        foreach ($this->serie as $value) {
            switch ($value) {
                case 1:
                    array_push($dice1, "*");
                    break;
                case 2:
                    array_push($dice2, "*");
                    break;
                case 3:
                    array_push($dice3, "*");
                    break;
                case 4:
                    array_push($dice4, "*");
                    break;
                case 5:
                    array_push($dice5, "*");
                    break;
                case 6:
                    array_push($dice6, "*");
                    break;

                default:
                    break;
            }
        }

        return array($dice1, $dice2, $dice3, $dice4, $dice5, $dice6);
    }

    /**
     * Return a string with a textual representation of the histogram.
     *
     * @return string representing the histogram.
     */
    public function getAsText(): string
    {
        $dices = $this->buildHistogram();
        $text = "";

        foreach ($dices as $key => $dice) {
            $text .= sprintf("<br>%s: ", $key+1);

            foreach ($dice as $value) {
                $text .= $value;
            }
        }

        return $text;
    }
}
