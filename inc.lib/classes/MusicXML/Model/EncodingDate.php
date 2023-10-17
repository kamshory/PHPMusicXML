<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * EncodingDate
 * -
 * EncodingDate is class of element &lt;encoding-date&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;encoding&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="encoding-date")
 * @ParentElement(name="encoding")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/encoding-date/
 * @Data
 */
class EncodingDate extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var DateTime
	 */
	public $textContent;
}