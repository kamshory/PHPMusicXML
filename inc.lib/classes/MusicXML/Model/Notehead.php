<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Notehead
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/notehead/
 * @Data
 */
class Notehead extends MusicXMLWriter
{
	/**
	 * Color
	 *
	 * @Attribute(name="color")
	 * @var string
	 */
	public $color;

	/**
	 * Filled
	 *
	 * @Attribute(name="filled")
	 * @var string
	 */
	public $filled;

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