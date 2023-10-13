<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * ExceptVoice
 * -
 * ExceptVoice is class of element &lt;except-voice&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;beat-repeat&gt;, &lt;slash&gt;
 * 
 * @Xml
 * @MusicXML
 * @ParentEelement="beat-repeat,slash")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/except-voice/
 * @Data
 */
class ExceptVoice extends MusicXMLWriter
{

    /**
     * Description
     *
     * @TextContent
     * @var string
     */
    public $textContent;
}