<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Accidental
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/accidental/
 * @Data
 */
class Accidental extends MusicXMLWriter
{
	/**
	 * Bracket
	 *
	 * @Attribute(name="bracket")
	 * @var string
	 */
	public $bracket;

	/**
	 * Cautionary
	 *
	 * @Attribute(name="cautionary")
	 * @var string
	 */
	public $cautionary;

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
	 * Editorial
	 *
	 * @Attribute(name="editorial")
	 * @var string
	 */
	public $editorial;

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
	 * Parentheses
	 *
	 * @Attribute(name="parentheses")
	 * @var string
	 */
	public $parentheses;

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
	 * Smufl
	 *
	 * @Attribute(name="smufl")
	 * @var string
	 */
	public $smufl;
	
	/**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
    
}