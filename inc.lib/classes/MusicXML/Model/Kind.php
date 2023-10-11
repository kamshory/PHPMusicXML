<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Kind
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/kind/
 * @Data
 */
class Kind extends MusicXMLWriter
{
	/**
	 * Bracket degrees
	 *
	 * @Attribute(name="bracket-degrees")
	 * @var string
	 */
	public $bracketDegrees;

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
	 * Parentheses degrees
	 *
	 * @Attribute(name="parentheses-degrees")
	 * @var string
	 */
	public $parenthesesDegrees;

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
	 * Stack degrees
	 *
	 * @Attribute(name="stack-degrees")
	 * @var string
	 */
	public $stackDegrees;

	/**
	 * Text
	 *
	 * @Attribute(name="text")
	 * @var string
	 */
	public $text;

	/**
	 * Use symbols
	 *
	 * @Attribute(name="use-symbols")
	 * @var string
	 */
	public $useSymbols;

	/**
	 * Valign
	 *
	 * @Attribute(name="valign")
	 * @var string
	 */
	public $valign;
    
	/**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}