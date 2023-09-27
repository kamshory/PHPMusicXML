<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Direction
 * @Xml
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
     * @var string
     */
    public $directionType;
    
    /**
     * Staff
     *
     * @PropertyElement
     * @var string
     */
    public $staff;
}