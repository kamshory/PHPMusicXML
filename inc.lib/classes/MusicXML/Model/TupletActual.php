<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * TupletActual
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/tuplet-actual/
 * @Data
 */
class TupletActual extends MusicXMLWriter
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