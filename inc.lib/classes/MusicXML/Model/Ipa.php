<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Ipa
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/ipa/
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