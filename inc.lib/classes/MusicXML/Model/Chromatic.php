<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Chromatic
 * -
 * Chromatic is class of element &lt;chromatic&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;part-transpose&gt;, &lt;transpose&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="chromatic")
 * @ParentElement(name="part-transpose,transpose")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/chromatic/
 * @Data
 */
class Chromatic extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}