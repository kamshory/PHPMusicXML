<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * HoleClosed
 * -
 * HoleClosed is class of element &lt;hole-closed&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;hole&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="hole-closed")
 * @ParentElement(name="hole")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/hole-closed/
 * @Data
 */
class HoleClosed extends MusicXMLWriter
{
	/**
	 * Location
	 * -
	 * Indicates which portion of the hole is filled in when the element value is half.
	 *
	 * @Attribute(name="location")
	 * @Value(type="hole-closed-location" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $location;

	/**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}