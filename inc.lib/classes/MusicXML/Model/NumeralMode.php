<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * NumeralMode
 * -
 * NumeralMode is class of element &lt;numeral-mode&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;numeral-key&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="numeral-mode")
 * @ParentElement(name="numeral-key")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/numeral-mode/
 * @Data
 */
class NumeralMode extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}