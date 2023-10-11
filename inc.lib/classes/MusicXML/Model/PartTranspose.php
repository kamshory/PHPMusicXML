<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PartTranspose
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/part-transpose/
 * @Data
 */
class PartTranspose extends MusicXMLWriter
{
    /**
     * Diatonic
     * @Element
     * @var Diatonic
     */
    public $diatonic;
    
    /**
     * Chromatic
     * @PropertyElement
     * @var Chromatic
     */
    public $chromatic;
    
    /**
     * Octave change
     * @Element(name="octave-change")
     * @var OctaveChange
     */
    public $octaveChange;
    
    /**
     * Double
     * @PropertyElement(name="double")
     * @var string
     */
    public $double;
}
