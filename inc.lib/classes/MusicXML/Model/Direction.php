<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Direction
 * @Xml
 * @Path /path/measure/direction
 * @Data
 */
class Direction extends MusicXMLWriter
{
    /**
     * Placement
     *
     * @Attribute
     * @var string
     */
    public $placement;
    
    /**
     * Direction type
     *
     * @PropertyElement(name="direction-type")
     * @var DirectionType
     */
    public $directionType;
    
    /**
     * Staff
     *
     * @PropertyElement
     * @var integer
     */
    public $staff;
    
    /**
     * Sound
     *
     * @PropertyElement
     * @var Sound
     */
    public $sound;
}