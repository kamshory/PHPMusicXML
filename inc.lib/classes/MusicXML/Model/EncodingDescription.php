<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * EncodingDescription
 * -
 * EncodingDescription is class of element &lt;encoding-description&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;encoding&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="encoding-description")
 * @ParentElement(name="encoding")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/encoding-description/
 * @Data
 */
class EncodingDescription extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}