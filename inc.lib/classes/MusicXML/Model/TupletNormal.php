<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * TupletNormal
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/tuplet-normal/
 * @Data
 */
class TupletNormal extends MusicXMLWriter
{
    /**
     * Tuplet number
     * @Element(name="tuplet-number")
     * @var TupletNumber
     */
    public $tupletNumber;
    
    /**
     * Tuplet type
     * @Element(name="tuplet-type")
     * @var TupletType
     */
    public $tupletType;
    
    /**
     * Tuplet dot
     * @Element(name="tuplet-dot")
     * @var TupletDot
     */
    public $tupletDot;
}