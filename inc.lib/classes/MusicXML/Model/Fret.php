<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Fret
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/fret/
 * @Data
 */
class Fret extends MusicXMLWriter
{
	/**
	 * Color
	 *
	 * @Attribute(name="color")
	 * @var string
	 */
	public $color;

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
    
}