<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * TuningAlter
 * -
 * TuningAlter is class of element &lt;tuning-alter&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;accord&gt;, &lt;staff-tuning&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="tuning-alter")
 * @ParentElement(name="accord,staff-tuning")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/tuning-alter/
 * @Data
 */
class TuningAlter extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}