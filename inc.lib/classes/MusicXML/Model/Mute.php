<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Mute
 * @Xml
 * @MusicXML
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