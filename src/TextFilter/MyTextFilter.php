<?php

namespace Schanihbg\TextFilter;

use \Michelf\Markdown;

/**
 * Filter and format text content.
 *
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 * @SuppressWarnings(PHPMD.UnusedPrivateField)
 */
class MyTextFilter
{
    use MyTTextUtilities;

    /**
     * Call a specific filter and store its details.
     *
     * @param string $filter to use.
     *
     * @throws mos/TextFilter/Exception when filter does not exists.
     *
     * @return string the formatted text.
     */
    private function parseFactory($filter)
    {
        // Define single tasks filter with a callback.
        $callbacks = [
            "bbcode"    => "bbcode2html",
            "link" => "makeClickable",
            "nl2br"     => "nl2br",
            "htmlentities" => "htmlentities",
            "markdown" => "markdown"
        ];

        // Do the specific filter
        $text = $this->current->text;

        switch ($filter) {
            case "bbcode":
            case "link":
            case "markdown":
            //case "geshi":
            case "nl2br":
            case "htmlentities":
                $this->current->text = call_user_func_array(
                    [$this, $callbacks[$filter]],
                    [$text]
                );
                break;

            default:
                throw new Exception("The filter '$filter' is not a valid filter     string.");
        }
    }



    /**
     * Call each filter and return array with details of the formatted content.
     *
     * @param string $text   the text to filter.
     * @param array  $filter array of filters to use.
     *
     * @throws Anax\TextFilter\Exception  when filter does not exists.
     *
     * @return array with the formatted text and additional details.
     */
    public function parse($text, $filter)
    {
        $this->current = new \stdClass();
        $this->current->frontmatter = [];
        $this->current->text = $text;

        foreach ($filter as $key) {
            $this->parseFactory($key);
        }

        $this->current->text = $this->getUntilStop($this->current->text);

        return $this->current;
    }



    /**
     * Helper, BBCode formatting converting to HTML.
     *
     * @param string $text The text to be converted.
     *
     * @return string the formatted text.
     */
    public function bbcode2html($text)
    {
        $search = [
            '/\[b\](.*?)\[\/b\]/is',
            '/\[i\](.*?)\[\/i\]/is',
            '/\[u\](.*?)\[\/u\]/is',
            '/\[img\](https?.*?)\[\/img\]/is',
            '/\[url\](https?.*?)\[\/url\]/is',
            '/\[url=(https?.*?)\](.*?)\[\/url\]/is'
        ];

        $replace = [
            '<strong>$1</strong>',
            '<em>$1</em>',
            '<u>$1</u>',
            '<img src="$1" />',
            '<a href="$1">$1</a>',
            '<a href="$1">$2</a>'
        ];

        return preg_replace($search, $replace, $text);
    }



    /**
     * Make clickable links from URLs in text.
     *
     * @param string $text The text that should be formatted.
     *
     * @return string with formatted anchors.
     */
    public function makeClickable($text)
    {
        return preg_replace_callback(
            '#\b(?<![href|src]=[\'"])https?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#',
            function ($matches) {
                return "<a href=\"{$matches[0]}\">{$matches[0]}</a>";
            },
            $text
        );
    }



    /**
     * Format text according to Markdown syntax.
     *
     * @param string $text The text that should be formatted.
     *
     * @return string as the formatted html text.
     @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function markdown($text)
    {
        return Markdown::defaultTransform($text);
    }



    /**
     * For convenience access to nl2br formatting of text.
     *
     * @param string $text The text that should be formatted.
     *
     * @return string the formatted text.
     */
    public function nl2br($text)
    {
        return nl2br($text);
    }

    /**
     * For convenience access to htmlentities
     *
     * @param string $text text to be converted.
     *
     * @return string the formatted text.
     */
    public function htmlentities($text)
    {
        return htmlentities($text);
    }
}
