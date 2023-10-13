<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * SwingType
 * -
 * SwingType is class of element &lt;swing-type&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;swing&gt;
 * 
 * @Xml
 * @MusicXML
 * @ParentEelement="swing")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/swing-type/
 * @Data
 */
class SwingType extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}