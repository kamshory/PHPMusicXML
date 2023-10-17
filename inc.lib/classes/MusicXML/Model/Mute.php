<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Mute
 * -
 * Mute is class of element &lt;mute&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;play&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="mute")
 * @ParentElement(name="play")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/mute/
 * @Data
 */
class Mute extends MusicXMLWriter
{

    /**
     * Text content
     *
     * @TextContent
     * @var string
     */
    public $textContent;
}