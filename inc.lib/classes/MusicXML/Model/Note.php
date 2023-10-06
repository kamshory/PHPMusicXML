<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Note
 * @Xml
 * @Path /path/measure/note
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/note/
 * @Data
 */
class Note extends MusicXMLWriter
{
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
     * Dynamics
     *
     * @Attribute
     * @var float
     */
    public $dynamics;

    /**
     * @Element
     * @var Rest
     */
    public $rest;
    
    /**
     * Pitch
     * 
     * @Element
     * @var Pitch
     */
    public $pitch;

    /**
     * @PropertyElement
     * @var float
     */
    public $duration;

    /**
     * @PropertyElement
     * @var string
     */
    public $voice;

    /**
     * @PropertyElement
     * @var string
     */
    public $type;

    /**
     * @PropertyElement
     * @var string
     */
    public $accidental;
    
    /**
     * @PropertyElement
     * @var string
     */
    public $stem;
    
    /**
     * @Element
     * @var Notations
     */
    public $notations;

    /**
     * @PropertyElement
     * @var string
     */
    public $unpitched;

    /**
     * @PropertyElement
     * @var integer
     */
    public $staff;

    /**
     * @PropertyElement
     * @var string
     */
    public $chord;

    /**
     * @Element
     * @var Beam
     */
    public $beam;
    
    /**
     * Tie
     * @PropertyElement
     * @var Tie
     */
    public $tie;
    
    /**
     * Lyric
     *
     * @PropertyElement
     * @var Lyric
     */
    public $lyric;


    /**
     * Grace
     *
     * @Element
     * @var Grace
     */
    public $grace;
}