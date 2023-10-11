<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * FiguredBass
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/figured-bass/
 * @Data
 */
class FiguredBass extends MusicXMLWriter
{
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
	 * Halign
	 *
	 * @Attribute(name="halign")
	 * @var string
	 */
	public $halign;

	/**
	 * Id
	 *
	 * @Attribute(name="id")
	 * @var string
	 */
	public $id;

	/**
	 * Parentheses
	 *
	 * @Attribute(name="parentheses")
	 * @var string
	 */
	public $parentheses;

	/**
	 * Placement
	 *
	 * @Attribute(name="placement")
	 * @var string
	 */
	public $placement;

	/**
	 * Print dot
	 *
	 * @Attribute(name="print-dot")
	 * @var string
	 */
	public $printDot;

	/**
	 * Print lyric
	 *
	 * @Attribute(name="print-lyric")
	 * @var string
	 */
	public $printLyric;

	/**
	 * Print object
	 *
	 * @Attribute(name="print-object")
	 * @var string
	 */
	public $printObject;

	/**
	 * Print spacing
	 *
	 * @Attribute(name="print-spacing")
	 * @var string
	 */
	public $printSpacing;

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
	 * Valign
	 *
	 * @Attribute(name="valign")
	 * @var string
	 */
	public $valign;
	
	/**
     * Figure
     *
     * @Element(name="figure")
     * @var Figure[]
     */
    public $figure;

    /**
     * Duration
     *
     * @Element(name="duration")
     * @var Duration
     */
    public $duration;

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