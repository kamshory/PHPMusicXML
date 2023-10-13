<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Sign
 * -
 * Sign is class of element &lt;sign&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;clef&gt;, &lt;part-clef&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="sign")
 * @ParentElement(name="clef,part-clef")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/sign/
 * @Data
 */
class Sign extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}