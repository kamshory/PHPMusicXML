<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Pan
 * -
 * Pan is class of element &lt;pan&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;midi-instrument&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="pan")
 * @ParentElement(name="midi-instrument")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/pan/
 * @Data
 */
class Pan extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}