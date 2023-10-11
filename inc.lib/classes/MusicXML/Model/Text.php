<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Text
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/text/
 * @Data
 */
class Text extends MusicXMLWriter
{
	/**
	 * Color
	 *
	 * @Attribute(name="color")
	 * @var string
	 */
	public $color;

	/**
	 * Dir
	 *
	 * @Attribute(name="dir")
	 * @var string
	 */
	public $dir;

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
	 * Letter spacing
	 *
	 * @Attribute(name="letter-spacing")
	 * @var string
	 */
	public $letterSpacing;

	/**
	 * Line through
	 *
	 * @Attribute(name="line-through")
	 * @var string
	 */
	public $lineThrough;

	/**
	 * Overline
	 *
	 * @Attribute(name="overline")
	 * @var string
	 */
	public $overline;

	/**
	 * Rotation
	 *
	 * @Attribute(name="rotation")
	 * @var string
	 */
	public $rotation;

	/**
	 * Underline
	 *
	 * @Attribute(name="underline")
	 * @var string
	 */
	public $underline;

	/**
	 * Xml:lang
	 *
	 * @Attribute(name="xml:lang")
	 * @var string
	 */
	public $xmlLang;
    
	/**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}