<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Attributes
 * -
 * Attributes is class of element &lt;attributes&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;measure&gt; (partwise), &lt;part&gt; (timewise)
 * 
 * @Xml
 * @MusicXML
 * @Element(name="attributes")
 * @ParentElement(name="measure (partwise),part (timewise)")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/attributes/
 * @Data
 */
class Attributes extends MusicXMLWriter
{

    /**
     * Divisions
     * @Element
     * @var Divisions
     */
    public $divisions;

    /**
     * Key
     * @Element
     * @var Key[]
     */
    public $key;

    /**
     * Time
     * @Element
     * @var Time
     */
    public $time;

    /**
     * Staves
     * @Element
     * @var Staves
     */
    public $staves;

    /**
     * Clef
     * @Element
     * @var Clef[]
     */
    public $clef;

    /**
     * Transpose
     * @Element
     * @var Transpose
     */
    public $transpose;

    /**
     * Footnote
     *
     * @Element
     * @var Footnote
     */
    public $footnote;

    /**
     * Level
     *
     * @Element
     * @var Level
     */
    public $level;

    /**
     * Part symbol
     *
     * @Element(name="part-symbol")
     * @var PartSymbol
     */
    public $partSymbol;

    /**
     * Staff details
     *
     * @Element(name="staff-detail")
     * @var StaffDetails
     */
    public $staffDetails;

    /**
     * Directive
     *
     * @Element
     * @var Directive
     */
    public $directive;

    /**
     * Measure style
     *
     * @Element(name="measure-style")
     * @var MeasureStyle
     */
    public $measureStyle;

    /**
     * Instruments
     *
     * @Element
     * @var Instruments
     */
    public $instruments;
}