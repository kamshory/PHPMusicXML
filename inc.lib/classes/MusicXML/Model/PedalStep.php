<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PedalStep
 * -
 * PedalStep is class of element &lt;pedal-step&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;pedal-tuning&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="pedal-step")
 * @ParentElement(name="pedal-tuning")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/pedal-step/
 * @Data
 */
class PedalStep extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}