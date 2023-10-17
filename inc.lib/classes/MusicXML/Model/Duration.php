<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Duration
 * -
 * Duration is class of element &lt;duration&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;backup&gt;, &lt;figured-bass&gt;, &lt;forward&gt;, &lt;note&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="duration")
 * @ParentElement(name="backup,figured-bass,forward,note")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/duration/
 * @Data
 */
class Duration extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}