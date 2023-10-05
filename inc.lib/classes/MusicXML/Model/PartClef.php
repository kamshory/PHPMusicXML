<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PartClef
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/part-clef/
 * @Data
 */
class PartClef extends MusicXMLWriter
{
    /**
     * Sign
     *
     * @PropertyElement
     * @var string
     */
    public $sign;
    
    /**
     * Line
     *
     * @PropertyElement
     * @var integer
     */
    public $line;
    
    /**
     * Clef octave change
     *
     * @PropertyElement(name="clef-octave-change")
     * @var string
     */
    public $clefOctaveChange;
}