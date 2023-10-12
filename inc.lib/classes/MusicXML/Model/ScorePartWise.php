<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * ScorePartWise
 * @Xml
 * @MusicXML
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
     * Movement number
     *
     * @Element(name="movement-number")
     * @var MovementNumber
     */
    public $movementNumber;
    
    /**
     * Movement title
     *
     * @Element(name="movement-title")
     * @var MovementTitle
     */
    public $movementTitle;
    
    /**
     * Defaults
     *
     * @Element(name="defaults")
     * @var Defaults
     */
    public $defaults;
    
    /**
     * Part list. Contains all instrument used on the music
     *
     * @Element(name="part-list")
     * @var PartList
     */
    public $partList;
    
    /**
     * Part. Part of the music. One part represent one instrument or group instrument
     *
     * @Element(name="part")
     * @var PartPartwise[]
     */
    public $part;
}