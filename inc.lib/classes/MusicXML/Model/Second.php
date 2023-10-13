<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Second
 * -
 * Second is class of element &lt;second&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;swing&gt;
 * 
 * @Xml
 * @MusicXML
 * @ParentEelement="swing")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/second/
 * @Data
 */
class Second extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}