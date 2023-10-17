<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Staff
 * -
 * Staff is class of element &lt;staff&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;direction&gt;, &lt;forward&gt;, &lt;harmony&gt;, &lt;note&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="staff")
 * @ParentElement(name="direction,forward,harmony,note")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/staff/
 * @Data
 */
class Staff extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}