<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * KeyAlter
 * -
 * KeyAlter is class of element &lt;key-alter&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;key&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="key-alter")
 * @ParentElement(name="key")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/key-alter/
 * @Data
 */
class KeyAlter extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}