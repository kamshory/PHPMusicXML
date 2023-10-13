<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Voice
 * -
 * Voice is class of element &lt;voice&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;direction&gt;, &lt;forward&gt;, &lt;note&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="voice")
 * @ParentElement(name="direction,forward,note")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/voice/
 * @Data
 */
class Voice extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}