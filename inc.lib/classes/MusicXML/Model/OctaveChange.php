<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * OctaveChange
 * -
 * OctaveChange is class of element &lt;octave-change&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;part-transpose&gt;, &lt;transpose&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="octave-change")
 * @ParentElement(name="part-transpose,transpose")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/octave-change/
 * @Data
 */
class OctaveChange extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}