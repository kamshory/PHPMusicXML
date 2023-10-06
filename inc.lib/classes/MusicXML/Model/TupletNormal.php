<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * TupletNormal
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/tuplet-normal/
 * @Data
 */
class TupletNormal extends MusicXMLWriter
{
    /**
     * Tuplet number
     * @PropertyElement(name="tuplet-number")
     * @var string
     */
    public $tupletNumber;
    
    /**
     * Tuplet type
     * @PropertyElement(name="tuplet-type")
     * @var string
     */
    public $tupletType;
    
    /**
     * Tuplet dot
     * @PropertyElement(name="tuplet-dot")
     * @var string
     */
    public $tupletDot;
}