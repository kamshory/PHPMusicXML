<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * TuningStep
 * -
 * TuningStep is class of element &lt;tuning-step&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;accord&gt;, &lt;staff-tuning&gt;
 * 
 * @Xml
 * @MusicXML
 * @ParentEelement="accord,staff-tuning")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/tuning-step/
 * @Data
 */
class TuningStep extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}