<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * HoleShape
 * -
 * HoleShape is class of element &lt;hole-shape&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;hole&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="hole-shape")
 * @ParentElement(name="hole")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/hole-shape/
 * @Update(date-time="2023-10-26 11:23:24")
 * @Data
 */
class HoleShape extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}