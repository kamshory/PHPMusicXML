<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Tied
 * @Xml
 * @Path /path/measure/note/notation/tied
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/tied/
 * @Data
 */
class Tied extends MusicXMLWriter
{
    /**
     * Number
     *
     * @Attribute
     * @var string
     */
    public $number;
    
    /**
     * Orientation
     *
     * @Attribute
     * @var string
     */
    public $orientation;
    
    /**
     * Type
     *
     * @Attribute
     * @var string
     */
    public $type;
}