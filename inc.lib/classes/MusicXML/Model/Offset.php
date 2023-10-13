<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Offset
 * -
 * Offset is class of element &lt;offset&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;direction&gt;, &lt;harmony&gt;, &lt;listening&gt;, &lt;sound&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="offset")
 * @ParentElement(name="direction,harmony,listening,sound")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/offset/
 * @Data
 */
class Offset extends MusicXMLWriter
{
	/**
	 * Sound
	 * -
	 * The offset affects the visual appearance of the direction. If the sound attribute is yes, then the offset affects playback and listening too. If it is no, then any &lt;sound&gt; or &lt;listening&gt; associated with the &lt;direction&gt; takes effect at the current location. It is no if not specified for compatibility with earlier MusicXML versions.
	 *
	 * @Attribute(name="sound")
	 * @Value(type="yes-no" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $sound;

	/**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}