<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Beater
 * -
 * Beater is class of element &lt;beater&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;percussion&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="beater")
 * @ParentElement(name="percussion")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/beater/
 * @Data
 */
class Beater extends MusicXMLWriter
{
	/**
	 * Tip
	 * -
	 * Indicates the direction in which the tip of the beater points.
	 *
	 * @Attribute(name="tip")
	 * @Value(type="tip-direction" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $tip;

	/**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}