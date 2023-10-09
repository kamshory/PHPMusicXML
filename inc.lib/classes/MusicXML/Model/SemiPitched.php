<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * SemiPitched
 * @Xml
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