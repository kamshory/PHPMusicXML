<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PartClef
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/part-clef/
 * @Data
 */
class PartClef extends MusicXMLWriter
{
    /**
     * Sign
     *
     * @Element
     * @var Sign(name="sign")
     */
    public $sign;
    
    /**
     * Line
     *
     * @Element
     * @var Line
     */
    public $line;
    
    /**
     * Clef octave change
     *
     * @Element(name="clef-octave-change")
     * @var ClefOctaveChange
     */
    public $clefOctaveChange;
}