<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * LeftMargin
 * -
 * LeftMargin is class of element &lt;left-margin&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;page-margins&gt;, &lt;system-margins&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="left-margin")
 * @ParentElement(name="page-margins,system-margins")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/left-margin/
 * @Data
 */
class LeftMargin extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}