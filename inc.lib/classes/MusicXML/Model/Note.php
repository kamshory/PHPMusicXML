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
     * @Element
     * @var Duration
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
     * @Element
     * @var Accidental
     */
    public $accidental;
    
    /**
     * @PropertyElement
     * @var string
     */
    public $stem;
    
    /**
     * @Element
     * @var Notations[]
     */
    public $notations;

    /**
     * @Element
     * @var Unpitched
     */
    public $unpitched;

    /**
     * @PropertyElement
     * @var integer
     */
    public $staff;

    /**
     * @Element
     * @var Chord
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

    /**
     * Time modification
     *
     * @Element(name="time-modification")
     * @var TimeModification
     */
    public $timeModification;
}