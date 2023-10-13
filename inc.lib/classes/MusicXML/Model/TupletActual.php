<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * TupletActual
 * -
 * TupletActual is class of element &lt;tuplet-actual&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;tuplet&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="tuplet-actual")
 * @ParentElement(name="tuplet")
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