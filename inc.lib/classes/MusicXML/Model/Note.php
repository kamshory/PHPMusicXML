<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Note
 * Source https://github.com/talobin/MusicXML-Android/blob/master/parser/src/main/java/com/talobin/music/model/Note.kt
 * @Xml
 * @Data
 */
class Note extends MusicXMLWriter
{
    /**
     * Pitch
     * 
     * @Element
     * @var Pitch
     */
    public $pitch;

    /**
     * @PropertyElement
     * @var string
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
}