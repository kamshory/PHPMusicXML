<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MeasureRepeat
 * -
 * MeasureRepeat is class of element &lt;measure-repeat&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;measure-style&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="measure-repeat")
 * @ParentElement(name="measure-style")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/measure-repeat/
 * @Data
 */
class MeasureRepeat extends MusicXMLWriter
{
	/**
	 * Type
	 * -
	 * Indicates the starting or stopping point of the section displaying the measure repeat symbols.
	 *
	 * @Attribute(name="type")
	 * @Value(type="start-stop" required="true", allowed="start,stop")
	 * @var string
	 */
	public $type;

	/**
	 * Slashes
	 * -
	 * Specifies the number of slashes to use in the symbol. The value is 1 if not specified.
	 *
	 * @Attribute(name="slashes")
	 * @Value(type="positiveInteger" required="false", min="0", max="infinite")
	 * @var integer
	 */
	public $slashes;

	/**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}