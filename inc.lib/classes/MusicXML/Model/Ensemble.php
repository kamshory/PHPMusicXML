<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Ensemble
 * -
 * Ensemble is class of element &lt;ensemble&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;instrument-change&gt;, &lt;score-instrument&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="ensemble")
 * @ParentElement(name="instrument-change,score-instrument")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/ensemble/
 * @Data
 */
class Ensemble extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}