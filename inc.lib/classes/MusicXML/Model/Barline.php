<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Barline
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/barline/
 * @Data
 */
class Barline extends MusicXMLWriter
{
	/**
	 * Divisions
	 *
	 * @Attribute(name="divisions")
	 * @var string
	 */
	public $divisions;

	/**
	 * Id
	 *
	 * @Attribute(name="id")
	 * @var string
	 */
	public $id;

	/**
	 * Location
	 *
	 * @Attribute(name="location")
	 * @var string
	 */
	public $location;

	/**
     * Bar style
     *
     * @Element(name="bar-style")
     * @var BarStyle
     */
    public $barStyle;

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

    /**
     * Wavy line
     *
     * @Element(name="wavy-line")
     * @var WavyLine
     */
    public $wavyLine;

    /**
     * Segno
     *
     * @Element(name="segno")
     * @var Segno
     */
    public $segno;

    /**
     * Coda
     *
     * @Element(name="coda")
     * @var Coda
     */
    public $coda;

    /**
     * Fermata
     *
     * @Element(name="fermata")
     * @var Fermata[]
     */
    public $fermata;

    /**
     * Ending
     *
     * @Element(name="ending")
     * @var Ending
     */
    public $ending;

    /**
     * Repeat
     *
     * @Element(name="repeat")
     * @var Repeat
     */
    public $repeat;

    
}