<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PartSymbol
 * @Xml
 * @Referece https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/part-symbol/
 * @Data
 */
class PartSymbol extends MusicXMLWriter
{
    /**
     * Bottom staff
     * 
     * @Attribute(name="bottom-staff") 
     * @var string
     */
    public $bottomStaff;
    
    /**
     * Default X
     * 
     * @Attribute(name="default-x") 
     * @var float
     */
    public $defaultX;
    
    /**
     * Default Y
     * 
     * @Attribute(name="default-y") 
     * @var float
     */
    public $defaultY;
    
    /**
     * Relative X
     * 
     * @Attribute(name="relative-x")
     * @var string
     */
    public $relativeX;
    
    /**
     * Relative Y
     * 
     * @Attribute(name="relative-y")
     * @var string
     */
    public $relativeY;
    
    /**
     * Top staff
     * 
     * @Attribute(name="top-staff") 
     * @var string
     */
    public $topStaff;
}