<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Supports
 * @Xml
 * @Path /identification/encoding/supports
 * @Data
 */
class Supports extends MusicXMLWriter
{
    /**
     * Element
     *
     * @Attribute
     * @var string
     */
    public $element;
    
    /**
     * Attribute
     *
     * @Attribute
     * @var attribute
     */
    public $attribute;
    
    /**
     * Type
     *
     * @Attribute
     * @var string
     */
    public $type;
}