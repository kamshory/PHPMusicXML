<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Slash
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/slash/
 * @Data
 */
class Slash extends MusicXMLWriter
{

    /**
     * Type
     *
     * @Attribute
     * @var string
     */
    public $type;

    /**
     * Use dot
     *
     * @Attribute
     * @var string
     */
    public $useDot;

    /**
     * Use stems
     *
     * @Attribute
     * @var string
     */
    public $useStems;

    /**
     * Slash type
     * 
     * @PropertyElement
     * @var string
     */
    public $slashType;
    
    /**
     * Slash dot
     * 
     * @Element
     * @var SlashDot
     */
    public $slashDot;
    
    /**
     * Excpet voice
     * 
     * @Element
     * @var ExceptVoice
     */
    public $exceptVoice;
}