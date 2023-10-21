<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Note
 * -
 * Note is class of element &lt;note&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;measure&gt; (partwise), &lt;part&gt; (timewise)
 * 
 * @Xml
 * @MusicXML
 * @Element(name="note")
 * @ParentElement(name="measure (partwise),part (timewise)")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/note/
 * @Data
 */
class Note extends MusicXMLWriter
{
	/**
	 * Attack
	 * -
	 * Alters the starting time of the note from when it would otherwise occur based on the flow of durations - information that is specific to a performance. It is expressed in terms of divisions, either positive or negative. A &lt;note&gt; that stops a tie should not have an attack attribute. The attack and release attributes are independent of each other. The attack attribute only changes the starting time of a note.
	 *
	 * @Attribute(name="attack")
	 * @Value(type="divisions" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $attack;

	/**
	 * Color
	 * -
	 * Indicates the color of an element.
	 *
	 * @Attribute(name="color")
	 * @Value(type="color" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $color;

	/**
	 * Default x
	 * -
	 * Changes the computation of the default horizontal position. The origin is changed relative to the start of the entire current measure, at either the left barline or the start of the system. Positive x is right and negative x is left.
	 *
	 * @Attribute(name="default-x")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $defaultX;

	/**
	 * Default y
	 * -
	 * Changes the computation of the default vertical position. The origin is changed relative to the top line of the staff. Positive y is up and negative y is down.
	 *
	 * @Attribute(name="default-y")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $defaultY;

	/**
	 * Dynamics
	 * -
	 * Corresponds to MIDI 1.0's Note On velocity, expressed in terms of percentage of the default forte value (90 for MIDI 1.0).
	 *
	 * @Attribute(name="dynamics")
	 * @Value(type="non-negative-decimal" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $dynamics;

	/**
	 * End dynamics
	 * -
	 * Corresponds to MIDI 1.0's Note Off velocity, expressed in terms of percentage of the default forte value (90 for MIDI 1.0).
	 *
	 * @Attribute(name="end-dynamics")
	 * @Value(type="non-negative-decimal" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $endDynamics;

	/**
	 * Font family
	 * -
	 * A comma-separated list of font names.
	 *
	 * @Attribute(name="font-family")
	 * @Value(type="font-family" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $fontFamily;

	/**
	 * Font size
	 * -
	 * One of the CSS sizes or a numeric point size.
	 *
	 * @Attribute(name="font-size")
	 * @Value(type="font-size" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $fontSize;

	/**
	 * Font style
	 * -
	 * Normal or italic style.
	 *
	 * @Attribute(name="font-style")
	 * @Value(type="font-style" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $fontStyle;

	/**
	 * Font weight
	 * -
	 * Normal or bold weight.
	 *
	 * @Attribute(name="font-weight")
	 * @Value(type="font-weight" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $fontWeight;

	/**
	 * Id
	 * -
	 * Specifies an ID that is unique to the entire document.
	 *
	 * @Attribute(name="id")
	 * @Value(type="ID" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $id;

	/**
	 * Pizzicato
	 * -
	 * Used when just this note is sounded pizzicato, vs. the &lt;pizzicato&gt; element which changes overall playback between pizzicato and arco.
	 *
	 * @Attribute(name="pizzicato")
	 * @Value(type="yes-no" required="false", allowed="yes,no")
	 * @var string
	 */
	public $pizzicato;

	/**
	 * Print dot
	 * -
	 * Controls the printing of an augmentation dot separately from the rest of the note or rest. This is especially useful for notes that overlap in different voices, or for chord sheets that contain lyrics and chords but no melody. If print-object is set to no, this attribute is also interpreted as being set to no if not present.
	 *
	 * @Attribute(name="print-dot")
	 * @Value(type="yes-no" required="false", allowed="yes,no")
	 * @var string
	 */
	public $printDot;

	/**
	 * Print leger
	 * -
	 * Indicates whether leger lines are printed. Notes without leger lines are used to indicate indeterminate high and low notes. It is yes if not present unless print-object is set to no. This attribute is ignored for rests.
	 *
	 * @Attribute(name="print-leger")
	 * @Value(type="yes-no" required="false", allowed="yes,no")
	 * @var string
	 */
	public $printLeger;

	/**
	 * Print lyric
	 * -
	 * Controls the printing of a lyric separately from the rest of the note or rest. This is especially useful for notes that overlap in different voices, or for chord sheets that contain lyrics and chords but no melody. If print-object is set to no, this attribute is also interpreted as being set to no if not present.
	 *
	 * @Attribute(name="print-lyric")
	 * @Value(type="yes-no" required="false", allowed="yes,no")
	 * @var string
	 */
	public $printLyric;

	/**
	 * Print object
	 * -
	 * Specifies whether or not to print an object. It is yes if not specified.
	 *
	 * @Attribute(name="print-object")
	 * @Value(type="yes-no" required="false", allowed="yes,no")
	 * @var string
	 */
	public $printObject;

	/**
	 * Print spacing
	 * -
	 * Controls whether or not spacing is left for an invisible note or object. It is used only if no note, dot, or lyric is being printed. The value is yes (leave spacing) if not specified.
	 *
	 * @Attribute(name="print-spacing")
	 * @Value(type="yes-no" required="false", allowed="yes,no")
	 * @var string
	 */
	public $printSpacing;

	/**
	 * Relative x
	 * -
	 * Changes the horizontal position relative to the default position, either as computed by the individual program, or as overridden by the default-x attribute.  Positive x is right and negative x is left. It should be interpreted in the context of the &lt;offset&gt; element or directive attribute if those are present.
	 *
	 * @Attribute(name="relative-x")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $relativeX;

	/**
	 * Relative y
	 * -
	 * Changes the vertical position relative to the default position, either as computed by the individual program, or as overridden by the default-y attribute. Positive y is up and negative y is down. It should be interpreted in the context of the placement attribute if that is present.
	 *
	 * @Attribute(name="relative-y")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $relativeY;

	/**
	 * Release
	 * -
	 * Alters the stopping time of the note from when it would otherwise occur based on the flow of durations - information that is specific to a performance. It is expressed in terms of divisions, either positive or negative. A &lt;note&gt; that starts a tie should not have a release attribute. The attack and release attributes are independent of each other. The release attribute only changes the stopping time of a note.
	 *
	 * @Attribute(name="release")
	 * @Value(type="divisions" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $release;

	/**
	 * Time only
	 * -
	 * Shows which times to play the note during a repeated section.
	 *
	 * @Attribute(name="time-only")
	 * @Value(type="time-only" required="false", allowed="ANY_VALUE")
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
     * Tie
     * @Element
     * @var Tie
     */
    public $tie;

    /**
     * Voice
     * @Element(name="voice")
     * @var Voice
     */
    public $voice;

	/**
     * Type
     *
     * @Element(name="type")
     * @var Type
     */
    public $type;

    /**
     * @Element
     * @var Accidental
     */
    public $accidental;

	/**
     * @Element
     * @var Beam
     */
    public $beam;

    /**
	 * Notations
	 *
     * @Element
     * @var Notations[]
     */
    public $notations;

    /**
	 * Unpitched
	 *
     * @Element
     * @var Unpitched
     */
    public $unpitched;

    /**
	 * Staff
	 *
     * @Element
     * @var Staff
     */
    public $staff;

    /**
     * @Element
     * @var Chord
     */
    public $chord;

    /**
     * Lyric
     *
     * @Element
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