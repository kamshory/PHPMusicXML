<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Ornaments
 * -
 * Ornaments is class of element &lt;ornaments&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;notations&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="ornaments")
 * @ParentElement(name="notations")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/ornaments/
 * @Data
 */
class Ornaments extends MusicXMLWriter
{
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
     * Trill marks
     *
     * @Element(name="trill-mark")
     * @var TrillMark
     */
    public $trillMark;

    /**
     * Turn
     *
     * @Element(name="turn")
     * @var Turn
     */
    public $turn;

    /**
     * Delayed turn
     *
     * @Element(name="delayed-turn")
     * @var DelayedTurn
     */
    public $delayedTurn;

    /**
     * Inverted turn
     *
     * @Element(name="inverted-turn")
     * @var InvertedTurn
     */
    public $invertedTurn;

    /**
     * Delayed inverted turn
     *
     * @Element(name="delayed-inverted-turn")
     * @var DelayedInvertedTurn
     */
    public $delayedInvertedTurn;

    /**
     * Vertical turn
     *
     * @Element(name="vertical-turn")
     * @var VerticalTurn
     */
    public $verticalTurn;

    /**
     * Inverted vertical turn
     *
     * @Element(name="inverted-vertical-turn")
     * @var InvertedVerticalTurn
     */
    public $invertedVerticalTurn;

    /**
     * Shake
     *
     * @Element(name="shake")
     * @var Shake
     */
    public $shake;

    /**
     * Wavy line
     *
     * @Element(name="navy-line")
     * @var WavyLine
     */
    public $wavyLine;

    /**
     * Mordent
     *
     * @Element(name="mordent")
     * @var Mordent
     */
    public $mordent;

    /**
     * Inverted mordent
     *
     * @Element(name="inverted-mordent")
     * @var InvertedMordent
     */
    public $invertedMordent;

    /**
     * Schleifer
     *
     * @Element(name="schleifer")
     * @var Schleifer
     */
    public $schleifer;

    /**
     * Tremolo
     *
     * @Element(name="tremolo")
     * @var Tremolo
     */
    public $tremolo;

    /**
     * Haydn
     *
     * @Element(name="haydn")
     * @var Haydn
     */
    public $haydn;

    /**
     * Other ornament
     *
     * @Element(name="other-ornament")
     * @var OtherOrnament
     */
    public $otherOrnament;

    /**
     * Accidental mark
     *
     * @Element(name="accidental-mark")
     * @var AccidentalMark[]
     */
    public $accidentalMark;

}