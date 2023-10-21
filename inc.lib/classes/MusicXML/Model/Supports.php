<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Supports
 * -
 * Supports is class of element &lt;supports&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;encoding&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="supports")
 * @ParentElement(name="encoding")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/supports/
 * @Data
 */
class Supports extends MusicXMLWriter
{
	/**
	 * Element
	 * -
	 * Indicates the element that is supported or not by the encoding.
	 *
	 * @Attribute(name="element")
	 * @Value(type="NMTOKEN" required="true", allowed="ANY_VALUE")
	 * @var string
	 */
	public $element;

	/**
	 * Type
	 * -
	 * If yes, the absence of a particular element with a specified attribute or value is meaningful. It indicates that this information is not present in the score. If no, the absence is not meaningful because the encoding does not include this type of information.
	 *
	 * @Attribute(name="type")
	 * @Value(type="yes-no" required="true", allowed="yes,no")
	 * @var string
	 */
	public $type;

	/**
	 * Attribute
	 * -
	 * Indicates a specific element attribute that is supported or not by the encoding.
	 *
	 * @Attribute(name="attribute")
	 * @Value(type="NMTOKEN" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $attribute;

	/**
	 * Value
	 * -
	 * Indicates a specific attribute value that is supported or not by the encoding. Only used together with the attribute attribute.
	 *
	 * @Attribute(name="value")
	 * @Value(type="token" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $value;

}