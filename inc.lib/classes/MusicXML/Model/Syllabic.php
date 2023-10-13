<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Syllabic
 * -
 * Syllabic is class of element &lt;syllabic&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;lyric&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="syllabic")
 * @ParentElement(name="lyric")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/syllabic/
 * @Data
 */
class Syllabic extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}