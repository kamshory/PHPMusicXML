<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Notations
 * -
 * Notations is class of element &lt;notations&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;note&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="notations")
 * @ParentElement(name="note")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/notations/
 * @Data
 */
class Notations extends MusicXMLWriter
{
	/**
	 * Id
	 * -
	 * Specifies an ID that is unique to the entire document.
	 *
	 * @Attribute(name="id")
	 * @Value(type="ID" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $id;

	/**
	 * Print object
	 * -
	 * Specifies whether or not to print an object. It is yes if not specified.
	 *
	 * @Attribute(name="print-object")
	 * @Value(type="yes-no" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $printObject;

    /**
     * Tied list
     *
     * @Element
     * @var Tied[]
     */
    public $tied;

    /**
     * Slur list
     *
     * @Element
     * @var Slur[]
     */
    public $slur;

    /**
     * Articulations
     *
     * @Element
     * @var Articulations
     */
    public $articulations;

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
     * Tuplet list
     *
     * @Element
     * @var Tuplet[]
     */
    public $tuplet;

    /**
     * Glissando
     *
     * @Element
     * @var Glissando
     */
    public $glissando;

    /**
     * Slide
     *
     * @Element
     * @var Slide
     */
    public $slide;

    /**
     * Ornament
     *
     * @Element
     * @var Ornaments[]
     */
    public $ornaments;

    /**
     * Technical
     *
     * @Element
     * @var Technical[]
     */
    public $technical;
}