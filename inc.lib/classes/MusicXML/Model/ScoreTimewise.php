<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * ScoreTimewise
 * -
 * ScoreTimewise is class of element &lt;score-timewise&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: none
 * 
 * @Xml
 * @MusicXML
 * @Element(name="score-timewise")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/score-timewise/
 * @Data
 */
class ScoreTimewise extends MusicXMLWriter
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
     * @Element(name="work")
     * @var Work
     */
    public $work;

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
     * Identification
     *
     * @Element(name="identification")
     * @var Identification
     */
    public $identification;

    /**
     * Defaults
     *
     * @Element(name="defaults")
     * @var Defaults
     */
    public $defaults;

    /**
     * Credit
     *
     * @Element(name="credit")
     * @var Credit[]
     */
    public $credit;

    /**
     * Part list
     *
     * @Element(name="part-list")
     * @var PartList
     */
    public $partList;

    /**
     * MeasurePartwise
     *
     * @Element(name="measure")
     * @var MeasurePartwise[]
     */
    public $measure;

}