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
     * @Element(name="rights")
     * @var Rights[]
     */
    public $rights;
    
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
     * @Element(name="creator")
     * @var Creator[]
     */
    public $creator;
    
    /**
     * Source
     *
     * @Attribute(name="source")
     * @var Source
     */
    public $source;
    
    /**
     * Relation
     *
     * @Attribute(name="relation")
     * @var Relation[]
     */
    public $relation;
    
    /**
     * Miscellaneous
     *
     * @Attribute(name="miscellaneous")
     * @var Miscellaneous[]
     */
    public $miscellaneous;
}