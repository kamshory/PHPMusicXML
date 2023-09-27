<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Tie
 * @Xml
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