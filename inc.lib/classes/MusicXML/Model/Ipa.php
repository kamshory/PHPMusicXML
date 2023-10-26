<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Ipa
 * -
 * Ipa is class of element &lt;ipa&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;play&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="ipa")
 * @ParentElement(name="play")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/ipa/
 * @Update(date-time="2023-10-26 11:23:39")
 * @Data
 */
class Ipa extends MusicXMLWriter
{

    /**
     * Text content
     *
     * @TextContent
     * @var string
     */
    public $textContent;
}