<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * VirtualInstrument
 * -
 * VirtualInstrument is class of element &lt;virtual-instrument&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;instrument-change&gt;, &lt;score-instrument&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="virtual-instrument")
 * @ParentElement(name="instrument-change,score-instrument")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/virtual-instrument/
 * @Data
 */
class VirtualInstrument extends MusicXMLWriter
{

    /**
     * Virtual library
     *
     * @Element(name="virtual-library")
     * @var VirtualLibrary
     */
    public $virtualLibrary;

    /**
     * Virtual name
     *
     * @Element(name="virtual-name")
     * @var VirtualName
     */
    public $virtualName;

}