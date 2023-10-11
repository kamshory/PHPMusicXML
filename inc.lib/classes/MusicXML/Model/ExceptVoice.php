<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * ExceptVoice
 * @Xml
 * @MusicXML
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