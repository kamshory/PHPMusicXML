<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * BendAlter
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/bend-alter/
 * @Data
 */
class BendAlter extends MusicXMLWriter
{
    /**
     * Text content
     *
     * @TextContent
     * @var float
     */
    public $textContent;
}