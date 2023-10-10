<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * ScorePartWise
 * @Xml
 * @Path /
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/score-partwise/
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
     * Work
     *
     * @Element
     * @var Work
     */
    public $work;
    
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
     * @var PartPartwise[]
     */
    public $part;
}