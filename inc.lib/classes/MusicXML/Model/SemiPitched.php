<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * SemiPitched
 * -
 * SemiPitched is class of element &lt;semi-pitched&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;play&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="semi-pitched")
 * @ParentElement(name="play")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/semi-pitched/
 * @Data
 */
class SemiPitched extends MusicXMLWriter
{

    /**
     * Text content
     *
     * @TextContent
     * @var string
     */
    public $textContent;
}