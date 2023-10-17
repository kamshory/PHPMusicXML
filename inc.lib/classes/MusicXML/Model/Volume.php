<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Volume
 * -
 * Volume is class of element &lt;volume&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;midi-instrument&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="volume")
 * @ParentElement(name="midi-instrument")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/volume/
 * @Data
 */
class Volume extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}