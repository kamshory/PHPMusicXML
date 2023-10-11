<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Plop
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/plop/
 * @Data
 */
class Plop extends MusicXMLWriter
{
	/**
	 * Color
	 *
	 * @Attribute(name="color")
	 * @var string
	 */
	public $color;

	/**
	 * Dash length
	 *
	 * @Attribute(name="dash-length")
	 * @var float
	 */
	public $dashLength;

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
	 * Line length
	 *
	 * @Attribute(name="line-length")
	 * @var string
	 */
	public $lineLength;

	/**
	 * Line shape
	 *
	 * @Attribute(name="line-shape")
	 * @var string
	 */
	public $lineShape;

	/**
	 * Line type
	 *
	 * @Attribute(name="line-type")
	 * @var string
	 */
	public $lineType;

	/**
	 * Placement
	 *
	 * @Attribute(name="placement")
	 * @var string
	 */
	public $placement;

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
	 * Space length
	 *
	 * @Attribute(name="space-length")
	 * @var float
	 */
	public $spaceLength;
    
}