<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Diatonic
 * -
 * Diatonic is class of element &lt;diatonic&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;part-transpose&gt;, &lt;transpose&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="diatonic")
 * @ParentElement(name="part-transpose,transpose")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/diatonic/
 * @Data
 */
class Diatonic extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}