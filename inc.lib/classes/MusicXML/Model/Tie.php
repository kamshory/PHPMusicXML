<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Tie
 * @Xml
 * @MusicXML
 * @Path /path/measure/note/tie
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/tie/
 * @Data
 */
class Tie extends MusicXMLWriter
{
    /**
     * Type
     *
     * @Attribute
     * @var string
     */
    public $type;
}