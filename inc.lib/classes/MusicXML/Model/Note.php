<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Note
 * Source https://github.com/talobin/MusicXML-Android/blob/master/parser/src/main/java/com/talobin/music/model/Note.kt
 * @Xml
 * @Path /path/measure/note
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/note/
 * @Data
 */
class Note extends MusicXMLWriter
{
    /**
     * Dynamics
     *
     * @var float
     */
    public $dynamics;
    
    /**
     * Direction
     *
     * @var [type]
     */
    public $direction;
    
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
    public $stem;

    /**
     * @PropertyElement
     * @var string
     */
    public $accidental;

    /**
     * @PropertyElement
     * @var string
     */
    public $unpitched;

    /**
     * @PropertyElement
     * @var string
     */
    public $staff;

    /**
     * @PropertyElement
     * @var string
     */
    public $chord;

    /**
     * @PropertyElement
     * @var string
     */
    public $rest;

    /**
     * @Element
     * @var Notation
     */
    public $notation;

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
}