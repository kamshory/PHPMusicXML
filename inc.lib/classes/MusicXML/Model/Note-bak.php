<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Note
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/note/
 * @Data
 */
class Note extends MusicXMLWriter
{
	/**
	 * Attack
	 *
	 * @Attribute(name="attack")
	 * @var string
	 */
	public $attack;

	/**
	 * Color
	 *
	 * @Attribute(name="color")
	 * @var string
	 */
	public $color;

	/**
	 * Default x
	 *
	 * @Attribute(name="default-x")
	 * @var float
	 */
	public $defaultX;

	/**
	 * Default y
	 *
	 * @Attribute(name="default-y")
	 * @var float
	 */
	public $defaultY;

	/**
	 * Dynamics
	 *
	 * @Attribute(name="dynamics")
	 * @var string
	 */
	public $dynamics;

	/**
	 * End dynamics
	 *
	 * @Attribute(name="end-dynamics")
	 * @var string
	 */
	public $endDynamics;

	/**
	 * Font family
	 *
	 * @Attribute(name="font-family")
	 * @var string
	 */
	public $fontFamily;

	/**
	 * Font size
	 *
	 * @Attribute(name="font-size")
	 * @var string
	 */
	public $fontSize;

	/**
	 * Font style
	 *
	 * @Attribute(name="font-style")
	 * @var string
	 */
	public $fontStyle;

	/**
	 * Font weight
	 *
	 * @Attribute(name="font-weight")
	 * @var string
	 */
	public $fontWeight;

	/**
	 * Id
	 *
	 * @Attribute(name="id")
	 * @var string
	 */
	public $id;

	/**
	 * Pizzicato
	 *
	 * @Attribute(name="pizzicato")
	 * @var string
	 */
	public $pizzicato;

	/**
	 * Print dot
	 *
	 * @Attribute(name="print-dot")
	 * @var string
	 */
	public $printDot;

	/**
	 * Print leger
	 *
	 * @Attribute(name="print-leger")
	 * @var string
	 */
	public $printLeger;

	/**
	 * Print lyric
	 *
	 * @Attribute(name="print-lyric")
	 * @var string
	 */
	public $printLyric;

	/**
	 * Print object
	 *
	 * @Attribute(name="print-object")
	 * @var string
	 */
	public $printObject;

	/**
	 * Print spacing
	 *
	 * @Attribute(name="print-spacing")
	 * @var string
	 */
	public $printSpacing;

	/**
	 * Relative x
	 *
	 * @Attribute(name="relative-x")
	 * @var float
	 */
	public $relativeX;

	/**
	 * Relative y
	 *
	 * @Attribute(name="relative-y")
	 * @var float
	 */
	public $relativeY;

	/**
	 * Release
	 *
	 * @Attribute(name="release")
	 * @var string
	 */
	public $release;

	/**
	 * Time only
	 *
	 * @Attribute(name="time-only")
	 * @var string
	 */
	public $timeOnly;

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
    
}