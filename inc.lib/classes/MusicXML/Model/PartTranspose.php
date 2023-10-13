<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PartTranspose
 * -
 * PartTranspose is class of element &lt;part-transpose&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;for-part&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="part-transpose")
 * @ParentElement(name="for-part")
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
     * @Element
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
     * XDouble
     * @Element(name="double")
     * @var XDouble
     */
    public $double;
}