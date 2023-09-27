<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Key
 * @Xml
 * @Path /path/measure/attribute/key
 * @Data
 */
class Key extends MusicXMLWriter
{   
    /**
     * Fifths
     *
     * @PropertyElement
     * @var string
     */
    public $fifths;
}