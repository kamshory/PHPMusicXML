<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Beats
 * -
 * Beats is class of element &lt;beats&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;interchangeable&gt;, &lt;time&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="beats")
 * @ParentElement(name="interchangeable,time")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/beats/
 * @Data
 */
class Beats extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}