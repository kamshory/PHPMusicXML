<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Staves
 * -
 * Staves is class of element &lt;staves&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;attributes&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="staves")
 * @ParentElement(name="attributes")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/staves/
 * @Update(date-time="2023-10-26 11:26:37")
 * @Data
 */
class Staves extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}