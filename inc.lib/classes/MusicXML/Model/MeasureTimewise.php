<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MeasureTimewise
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/measure-timewise/
 * @Data
 */
class MeasureTimewise extends MusicXMLWriter
{
	/**
	 * Number
	 *
	 * @Attribute(name="number")
	 * @var string
	 */
	public $number;

	/**
	 * Id
	 *
	 * @Attribute(name="id")
	 * @var string
	 */
	public $id;

	/**
	 * Implicit
	 *
	 * @Attribute(name="implicit")
	 * @var string
	 */
	public $implicit;

	/**
	 * Non controlling
	 *
	 * @Attribute(name="non-controlling")
	 * @var string
	 */
	public $nonControlling;

	/**
	 * Text
	 *
	 * @Attribute(name="text")
	 * @var string
	 */
	public $text;

	/**
	 * Width
	 *
	 * @Attribute(name="width")
	 * @var string
	 */
	public $width;
	
	/**
	 * Part
	 *
	 * @Element(name="part")
	 * @var Part[]
	 */
	public $part;
    
}