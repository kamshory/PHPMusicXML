<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Rights
 * -
 * Rights is class of element &lt;rights&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;identification&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="rights")
 * @ParentElement(name="identification")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/rights/
 * @Data
 */
class Rights extends MusicXMLWriter
{
	/**
	 * Type
	 * -
	 * Standard type values are music, words, and arrangement, but other types may be used. This attribute is only needed when there are multiple &lt;rights&gt; elements.
	 *
	 * @Attribute(name="type")
	 * @Value(type="token" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $type;

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}