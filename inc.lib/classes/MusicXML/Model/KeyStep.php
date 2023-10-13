<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * KeyStep
 * -
 * KeyStep is class of element &lt;key-step&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;key&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="key-step")
 * @ParentElement(name="key")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/key-step/
 * @Data
 */
class KeyStep extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}