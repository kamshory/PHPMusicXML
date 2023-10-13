<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PedalAlter
 * -
 * PedalAlter is class of element &lt;pedal-alter&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;pedal-tuning&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="pedal-alter")
 * @ParentElement(name="pedal-tuning")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/pedal-alter/
 * @Data
 */
class PedalAlter extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}