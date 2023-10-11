<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Figure
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/figure/
 * @Data
 */
class Figure extends MusicXMLWriter
{
    /**
     * Prefix
     *
     * @Element(name="prefix")
     * @var Prefix
     */
    public $prefix;

    /**
     * Figure number
     *
     * @Element(name="figure-number")
     * @var FigureNumber
     */
    public $figureNumber;

    /**
     * Suffix
     *
     * @Element(name="suffix")
     * @var Suffix
     */
    public $suffix;

    /**
     * Extend
     *
     * @Element(name="extend")
     * @var Extend
     */
    public $extend;

    /**
     * Footnote
     *
     * @Element(name="footnote")
     * @var Footnote
     */
    public $footnote;

    /**
     * Level
     *
     * @Element(name="level")
     * @var Level
     */
    public $level;


}