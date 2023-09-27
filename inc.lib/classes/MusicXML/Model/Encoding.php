<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Encoding
 * Source https://github.com/talobin/MusicXML-Android/blob/master/parser/src/main/java/com/talobin/music/model/Encoding.kt
 * @Xml
 * @Path /identification/encoding
 * @Data
 */
class Encoding extends MusicXMLWriter
{
    /**
     * Software list
     * @Element(name="software")
     * @var Software[]
     */
    public $softwareList;
    
    /**
     * Encoding date
     * @PropertyElement(name="encoding-date")
     * @var string
     */
    public $encodingDate;
    
    /**
     * Supports
     * @PropertyElement
     * @var Supports
     */
    public $supports;
}