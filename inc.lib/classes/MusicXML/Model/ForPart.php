<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * ForPart
 * @Xml
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
     * @PropertyElement
     * @var PartClef
     */
    public $partClef;
    
    /**
     * Part transpose
     *
     * @PropertyElement(name="part-transpose")
     * @var PartTranspose
     */
    public $partTranspose;
    
    
}