<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * DisplayOctave
 * -
 * DisplayOctave is class of element &lt;display-octave&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;rest&gt;, &lt;unpitched&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="display-octave")
 * @ParentElement(name="rest,unpitched")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/display-octave/
 * @Data
 */
class DisplayOctave extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}