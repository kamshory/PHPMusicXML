<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Identification
 * Source https://github.com/talobin/MusicXML-Android/blob/master/parser/src/main/java/com/talobin/music/model/Identification.kt
 * @Xml
 * @Path /identification
 * @Data
 */
class Identification extends MusicXMLWriter
{
    /**
     * Copyright
     * 
     * @PropertyElement(name="rights")
     * @var string
     */
    public $copyrights;
    
    /**
     * Description
     *
     * @Element
     * @var Encoding
     */
    public $encoding;
    
    /**
     * Creator
     * 
     * @PropertyElement(name="creator")
     * @var string
     */
    public $creator;
    
    /**
     * Creator type
     *
     * @Attribute(name="type")
     * @var string
     */
    public $creatorType;
}