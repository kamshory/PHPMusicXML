<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * LineDetail
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/line-detail/
 * @Data
 */
class LineDetail extends MusicXMLWriter
{
	/**
	 * Line
	 *
	 * @Attribute(name="line")
	 * @var string
	 */
	public $line;

	/**
	 * Color
	 *
	 * @Attribute(name="color")
	 * @var string
	 */
	public $color;

	/**
	 * Line type
	 *
	 * @Attribute(name="line-type")
	 * @var string
	 */
	public $lineType;

	/**
	 * Print object
	 *
	 * @Attribute(name="print-object")
	 * @var string
	 */
	public $printObject;

	/**
	 * Width
	 *
	 * @Attribute(name="width")
	 * @var string
	 */
	public $width;
    
}