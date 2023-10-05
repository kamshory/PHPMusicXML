<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * StaffDetail
 * @Xml
 * https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/staff-details/
 * @Data
 */
class StaffDetail extends MusicXMLWriter
{
    /**
     * Number
     *
     * @Attribute
     * @var integer
     */
    public $number;
    
    
    /**
     * Print object
     *
     * @Attribute(name="print-object")
     * @var string
     */
    public $printObject;
    
    /**
     * Print spacing
     *
     * @Attribute(name="print-spacing")
     * @var string
     */
    public $printSpacing;
    
    /**
     * Show frets
     *
     * @Attribute(name="show-frets")
     * @var string
     */
    public $showFrets;
    
    /**
     * Staff type
     *
     * @PropertyElement(name="staff-type")
     * @var string
     */
    public $staffType;
    
    /**
     * Staff lines
     *
     * @PropertyElement(name="staff-lines")
     * @var integer
     */
    public $staffLines;
    
    /**
     * Staff size
     *
     * @PropertyElement(name="staff-size")
     * @var float
     */
    public $staffSize;
}