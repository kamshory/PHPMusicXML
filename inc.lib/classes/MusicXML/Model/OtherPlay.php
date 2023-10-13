<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * OtherPlay
 * -
 * OtherPlay is class of element &lt;other-play&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;play&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="other-play")
 * @ParentElement(name="play")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/other-play/
 * @Data
 */
class OtherPlay extends MusicXMLWriter
{
	/**
	 * Type
	 * -
	 * Indicates the type of playback to which the element content applies.
	 *
	 * @Attribute(name="type")
	 * @Value(type="token" required="true", allowed="ANY_VALUE")
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