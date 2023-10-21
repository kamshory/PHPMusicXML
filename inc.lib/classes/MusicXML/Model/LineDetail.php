<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * LineDetail
 * -
 * LineDetail is class of element &lt;line-detail&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;staff-details&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="line-detail")
 * @ParentElement(name="staff-details")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/line-detail/
 * @Data
 */
class LineDetail extends MusicXMLWriter
{
	/**
	 * Line
	 * -
	 * Indicates the staff line affected, numbered from bottom to top.
	 *
	 * @Attribute(name="line")
	 * @Value(type="staff-line" required="true", min="1", max="infinite")
	 * @var integer
	 */
	public $line;

	/**
	 * Color
	 * -
	 * Indicates the color of an element.
	 *
	 * @Attribute(name="color")
	 * @Value(type="color" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $color;

	/**
	 * Line type
	 * -
	 * Specifies if the line is solid, dashed, dotted, or wavy.
	 *
	 * @Attribute(name="line-type")
	 * @Value(type="line-type" required="false", allowed="dashed,dotted,solid,wavy")
	 * @var string
	 */
	public $lineType;

	/**
	 * Print object
	 * -
	 * Specifies whether or not to print an object. It is yes if not specified.
	 *
	 * @Attribute(name="print-object")
	 * @Value(type="yes-no" required="false", allowed="yes,no")
	 * @var string
	 */
	public $printObject;

	/**
	 * Width
	 * -
	 * Staff line width in tenths.
	 *
	 * @Attribute(name="width")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $width;

}