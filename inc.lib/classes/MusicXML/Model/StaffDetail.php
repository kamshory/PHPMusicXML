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
     * @Element(name="staff-type")
     * @var StaffType
     */
    public $staffType;

    /**
     * Staff lines
     *
     * @Element(name="staff-lines")
     * @var StaffLines
     */
    public $staffLines;

    /**
     * Line detail
     *
     * @Element(name="line-detail")
     * @var LineDetail[]
     */
    public $lineDetail;

    /**
     * Staff tuning
     *
     * @Element(name="staff-tuning")
     * @var StaffTuning[]
     */
    public $staffTuning;

    /**
     * Capo
     *
     * @Element(name="capo")
     * @var Capo
     */
    public $capo;

    /**
     * Staff size
     *
     * @Element(name="staff-size")
     * @var StaffSize
     */
    public $staffSize;


}