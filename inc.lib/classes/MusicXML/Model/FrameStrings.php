<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * FrameStrings
 * -
 * FrameStrings is class of element &lt;frame-strings&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;frame&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="frame-strings")
 * @ParentElement(name="frame")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/frame-strings/
 * @Data
 */
class FrameStrings extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}