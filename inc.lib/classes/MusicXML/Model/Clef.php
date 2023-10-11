<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Clef
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/clef/
 * @Data
 */
class Clef extends MusicXMLWriter
{
	/**
	 * Additional
	 *
	 * @Attribute(name="additional")
	 * @var string
	 */
	public $additional;

	/**
	 * After barline
	 *
	 * @Attribute(name="after-barline")
	 * @var string
	 */
	public $afterBarline;

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
	 * Number
	 *
	 * @Attribute(name="number")
	 * @var string
	 */
	public $number;

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
	 * Size
	 *
	 * @Attribute(name="size")
	 * @var string
	 */
	public $size;
    
	/**
     * Sign
     *
     * @Element
     * @var Sign(name="sign")
     */
    public $sign;
    
    /**
     * Line
     *
     * @Element
     * @var Line
     */
    public $line;
    
    /**
     * Clef octave change
     *
     * @Element(name="clef-octave-change")
     * @var ClefOctaveChange
     */
    public $clefOctaveChange;
}