<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Note
 * @Xml
 * @MusicXML
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
     * Voice
     * @Element(name="voice")
     * @var Voice
     */
    public $voice;

    /**
     * @Element
     * @var Accidental
     */
    public $accidental;

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
    
    /**
     * Instrument
     *
     * @Element(name="instrument")
     * @var Instrument
     */
    public $instrument;
    
    /**
     * Type
     *
     * @Element(name="type")
     * @var Type
     */
    public $type;
    
    /**
     * Dot
     *
     * @Element(name="dot")
     * @var Dot
     */
    public $dot;
    
    /**
     * Cue
     *
     * @Element(name="cue")
     * @var Cue
     */
    public $cue;
    
    /**
     * Stem
     *
     * @Element(name="stem")
     * @var Stem
     */
    public $stem;
    
    /**
     * Notehead text
     *
     * @Element(name="notehead-text")
     * @var NoteheadText
     */
    public $noteheadText;
    
    /**
     * Attack
     *
     * @Attribute
     * @var integer
     */
    public $attack;

    /**
     * Release
     *
     * @Attribute
     * @var integer
     */
    public $release;
    
    
}