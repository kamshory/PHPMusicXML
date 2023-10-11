<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * AccidentalText
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/accidental-text/
 * @Data
 */
class AccidentalText extends MusicXMLWriter
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
	 * Dir
	 *
	 * @Attribute(name="dir")
	 * @var string
	 */
	public $dir;

	/**
	 * Enclosure
	 *
	 * @Attribute(name="enclosure")
	 * @var string
	 */
	public $enclosure;

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
	 * Justify
	 *
	 * @Attribute(name="justify")
	 * @var string
	 */
	public $justify;

	/**
	 * Letter spacing
	 *
	 * @Attribute(name="letter-spacing")
	 * @var string
	 */
	public $letterSpacing;

	/**
	 * Line height
	 *
	 * @Attribute(name="line-height")
	 * @var string
	 */
	public $lineHeight;

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
	 * Rotation
	 *
	 * @Attribute(name="rotation")
	 * @var string
	 */
	public $rotation;

	/**
	 * Smufl
	 *
	 * @Attribute(name="smufl")
	 * @var string
	 */
	public $smufl;

	/**
	 * Underline
	 *
	 * @Attribute(name="underline")
	 * @var string
	 */
	public $underline;

	/**
	 * Valign
	 *
	 * @Attribute(name="valign")
	 * @var string
	 */
	public $valign;

	/**
	 * Xml:lang
	 *
	 * @Attribute(name="xml:lang")
	 * @var string
	 */
	public $xmlLang;

	/**
	 * Xml:space
	 *
	 * @Attribute(name="xml:space")
	 * @var string
	 */
	public $xmlSpace;
	
	/**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
    
}