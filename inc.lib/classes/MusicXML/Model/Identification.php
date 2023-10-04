<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Identification
 * @Xml
 * @Path /identification
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/identification/
 * @Data
 */
class Identification extends MusicXMLWriter
{
    /**
     * Copyright
     * 
     * @PropertyElement(name="rights")
     * @var string
     */
    public $copyrights;
    
    /**
     * Description
     *
     * @Element
     * @var Encoding
     */
    public $encoding;
    
    /**
     * Creator
     * 
     * @PropertyElement(name="creator")
     * @var string
     */
    public $creator;
    
    /**
     * Creator type
     *
     * @Attribute(name="type")
     * @var string
     */
    public $creatorType;
}