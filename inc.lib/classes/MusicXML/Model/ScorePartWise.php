<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * ScorePartwise
 * -
 * ScorePartwise is class of element &lt;score-partwise&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: none
 * 
 * @Xml
 * @MusicXML
 * @Element(name="score-partwise")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/score-partwise/
 * @Data
 */
class ScorePartwise extends MusicXMLWriter
{
	/**
	 * Version
	 * -
	 * The version attribute was added in Version 1.1 for the score-partwise and score-timewise documents. It provides an easier way to get version information than through the MusicXML public ID. The default value is 1.0 to make it possible for programs that handle later versions to distinguish earlier version files reliably. Programs that write MusicXML 1.1 or later files should set this attribute.
	 *
	 * @Attribute(name="version")
	 * @Value(type="token" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $version;

    /**
     * Work
     *
     * @Element
     * @var Work
     */
    public $work;

    /**
     * Identification. Contains music identification
     *
     * @Element
     * @var Identification
     */
    public $identification;

    /**
     * Movement number
     *
     * @Element(name="movement-number")
     * @var MovementNumber
     */
    public $movementNumber;

    /**
     * Movement title
     *
     * @Element(name="movement-title")
     * @var MovementTitle
     */
    public $movementTitle;

    /**
     * Defaults
     *
     * @Element(name="defaults")
     * @var Defaults
     */
    public $defaults;

    /**
     * Part list. Contains all instrument used on the music
     *
     * @Element(name="part-list")
     * @var PartList
     */
    public $partList;

    /**
     * Part. Part of the music. One part represent one instrument or group instrument
     *
     * @Element(name="part")
     * @var PartPartwise[]
     */
    public $part;
}