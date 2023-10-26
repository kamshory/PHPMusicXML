<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Octave
 * -
 * Octave is class of element &lt;octave&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;pitch&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="octave")
 * @ParentElement(name="pitch")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/octave/
 * @Update(date-time="2023-10-26 11:24:50")
 * @Data
 */
class Octave extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}