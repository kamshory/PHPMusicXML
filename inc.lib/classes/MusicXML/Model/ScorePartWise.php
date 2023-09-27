<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * ScorePartWise
 * Source https://github.com/talobin/MusicXML-Android/blob/master/parser/src/main/java/com/talobin/music/model/ScorePartWise.kt
 * @Xml
 * @Path /
 * @Data
 */
class ScorePartWise extends MusicXMLWriter
{
    /**
     * Version
     *
     * @Attribute
     * @var string
     */
    public $version;
    
    /**
     * Identification
     *
     * @Element
     * @var Identification
     */
    public $identification;
    
    /**
     * Part list
     *
     * @Element
     * @var PartList
     */
    public $partList;
    
    /**
     * Part
     *
     * @Element
     * @var Part[]
     */
    public $parts;
}