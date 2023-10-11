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
     * @var string
     */
    public $chromatic;
    
    /**
     * Octave change
     * @PropertyElement(name="octave-change")
     * @var string
     */
    public $octaveChange;
    
    /**
     * Double
     * @PropertyElement(name="double")
     * @var string
     */
    public $double;
}
