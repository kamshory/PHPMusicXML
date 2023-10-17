<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Figure
 * -
 * Figure is class of element &lt;figure&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;figured-bass&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="figure")
 * @ParentElement(name="figured-bass")
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