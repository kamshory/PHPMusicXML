<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * ForPart
 * @Xml
 * @MusicXML
 * @Referece https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/for-part/
 * @Data
 */
class ForPart extends MusicXMLWriter
{
    /**
     * ID
     * 
     * @Attribute 
     * @var string
     */
    public $id;
    
    /**
     * Number
     * 
     * @Attribute 
     * @var integer
     */
    public $number;
    
    /**
     * Part clef
     *
     * @Element
     * @var PartClef(name="part-clef")
     */
    public $partClef;
    
    /**
     * Part transpose
     *
     * @Element(name="part-transpose")
     * @var PartTranspose
     */
    public $partTranspose;
    
    
}