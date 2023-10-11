<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Harmony
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/harmony/
 * @Data
 */
class Harmony extends MusicXMLWriter
{
	/**
	 * Arrangement
	 *
	 * @Attribute(name="arrangement")
	 * @var string
	 */
	public $arrangement;

	/**
	 * Color
	 *
	 * @Attribute(name="color")
	 * @var string
	 */
	public $color;

	/**
	 * Default x
	 *
	 * @Attribute(name="default-x")
	 * @var float
	 */
	public $defaultX;

	/**
	 * Default y
	 *
	 * @Attribute(name="default-y")
	 * @var float
	 */
	public $defaultY;

	/**
	 * Font family
	 *
	 * @Attribute(name="font-family")
	 * @var string
	 */
	public $fontFamily;

	/**
	 * Font size
	 *
	 * @Attribute(name="font-size")
	 * @var string
	 */
	public $fontSize;

	/**
	 * Font style
	 *
	 * @Attribute(name="font-style")
	 * @var string
	 */
	public $fontStyle;

	/**
	 * Font weight
	 *
	 * @Attribute(name="font-weight")
	 * @var string
	 */
	public $fontWeight;

	/**
	 * Id
	 *
	 * @Attribute(name="id")
	 * @var string
	 */
	public $id;

	/**
	 * Placement
	 *
	 * @Attribute(name="placement")
	 * @var string
	 */
	public $placement;

	/**
	 * Print frame
	 *
	 * @Attribute(name="print-frame")
	 * @var string
	 */
	public $printFrame;

	/**
	 * Print object
	 *
	 * @Attribute(name="print-object")
	 * @var string
	 */
	public $printObject;

	/**
	 * Relative x
	 *
	 * @Attribute(name="relative-x")
	 * @var float
	 */
	public $relativeX;

	/**
	 * Relative y
	 *
	 * @Attribute(name="relative-y")
	 * @var float
	 */
	public $relativeY;

	/**
	 * System
	 *
	 * @Attribute(name="system")
	 * @var string
	 */
	public $system;

	/**
	 * Type
	 *
	 * @Attribute(name="type")
	 * @var string
	 */
	public $type;

    /**
     * Root
     *
     * @Element(name="root")
     * @var Root
     */
    public $root;

    /**
     * Numeral
     *
     * @Element(name="numeral")
     * @var Numeral
     */
    public $numeral;

    /**
     * Function
     *
     * @Element(name="function")
     * @var Function
     */
    public $function;

    /**
     * Kind
     *
     * @Element(name="kind")
     * @var Kind[]
     */
    public $kind;

    /**
     * Inversion
     *
     * @Element(name="inversion")
     * @var Inversion[]
     */
    public $inversion;

    /**
     * Bass
     *
     * @Element(name="bass")
     * @var Bass[]
     */
    public $bass;

    /**
     * Degree
     *
     * @Element(name="degree")
     * @var Degree[]
     */
    public $degree;

    /**
     * Frame
     *
     * @Element(name="frame")
     * @var Frame
     */
    public $frame;

    /**
     * Offset
     *
     * @Element(name="offset")
     * @var Offset
     */
    public $offset;

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
     * Staff
     *
     * @Element(name="staff")
     * @var Staff
     */
    public $staff;


}