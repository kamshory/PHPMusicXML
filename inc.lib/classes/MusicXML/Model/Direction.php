<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Direction
 * @Xml
 * @Path /path/measure/direction
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/direction/
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