<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * HarmonClosed
 * -
 * HarmonClosed is class of element &lt;harmon-closed&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;harmon-mute&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="harmon-closed")
 * @ParentElement(name="harmon-mute")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/harmon-closed/
 * @Data
 */
class HarmonClosed extends MusicXMLWriter
{
	/**
	 * Location
	 * -
	 * Indicates which portion of the symbol is filled in when the element value is half.
	 *
	 * @Attribute(name="location")
	 * @Value(type="harmon-closed-location" required="false", allowed="ANY_VALUE")
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