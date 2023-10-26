<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Encoding
 * -
 * Encoding is class of element &lt;encoding&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;identification&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="encoding")
 * @ParentElement(name="identification")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/encoding/
 * @Update(date-time="2023-10-26 11:22:27")
 * @Data
 */
class Encoding extends MusicXMLWriter
{

    /**
     * Software list
     * @Element(name="software")
     * @var Software[]
     */
    public $software;

    /**
     * Encoding date
     * @Element(name="encoding-date")
     * @var EncodingDate[]
     */
    public $encodingDate;

    /**
     * Supports
     * @Element
     * @var Supports[]
     */
    public $supports;

    /**
     * Encoding description
     * @Element(name="encoding-description")
     * @var EncodingDescription[]
     */
    public $encodingDescription;

    /**
     * Encoder
     * @Element(name="encoder")
     * @var Encoder[]
     */
    public $encoder;
}