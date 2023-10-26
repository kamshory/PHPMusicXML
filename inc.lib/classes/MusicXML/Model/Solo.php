<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Solo
 * -
 * Solo is class of element &lt;solo&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;instrument-change&gt;, &lt;score-instrument&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="solo")
 * @ParentElement(name="instrument-change,score-instrument")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/solo/
 * @Update(date-time="2023-10-26 11:26:23")
 * @Data
 */
class Solo extends MusicXMLWriter
{

}