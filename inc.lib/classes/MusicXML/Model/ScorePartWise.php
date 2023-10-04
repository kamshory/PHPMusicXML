<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * ScorePartWise
 * @Xml
 * @Path /
 * @Data
 */
class ScorePartWise extends MusicXMLWriter
{
    /**
     * MusicXML version. Current version is 4.0
     *
     * @Attribute
     * @var string
     */
    public $version;
    
    /**
     * Identification. Contains music identification
     *
     * @Element
     * @var Identification
     */
    public $identification;
    
    /**
     * Part list. Contains all instrument used on the music
     *
     * @Element
     * @var PartList
     */
    public $partList;
    
    /**
     * Part. Part of the music. One part represent one instrument or group instrument
     *
     * @Element
     * @var Part[]
     */
    public $part;
}