<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Key
 * @Xml
 * @Path /path/measure/attribute/key
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/key/
 * @Data
 */
class Key extends MusicXMLWriter
{   
    /**
     * Fifths
     *
     * @PropertyElement
     * @var integer
     */
    public $fifths;

    /**
     * Mode
     *
     * @PropertyElement
     * @var string
     */
    public $mode;
}