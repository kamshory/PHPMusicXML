<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * SenzaMisura
 * -
 * SenzaMisura is class of element &lt;senza-misura&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;time&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="senza-misura")
 * @ParentElement(name="time")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/senza-misura/
 * @Update(date-time="2023-10-26 11:26:04")
 * @Data
 */
class SenzaMisura extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}