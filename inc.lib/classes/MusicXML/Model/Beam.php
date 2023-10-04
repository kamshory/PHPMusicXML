<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Beam
 * @Xml
 * @Path /path/measure/note/beam
 * @Referece https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/beam/
 * @Data
 */
class Beam extends MusicXMLWriter
{
    /**
     * Number
     * @Attribute
     * @var string
     */
    public $number;
    /**
     * Description
     * @TextContent
     * @var string
     */
    public $description;
}