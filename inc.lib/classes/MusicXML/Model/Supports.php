<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Supports
 * @Xml
 * @MusicXML
 * @Path /identification/encoding/supports
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/supports/
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
     * @var string
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