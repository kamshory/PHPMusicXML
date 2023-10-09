<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Ornaments
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/ornaments/
 * @Data
 */
class Ornaments extends MusicXMLWriter
{
    /**
     * ID
     *
     * @Attribute
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
     * Navy line
     *
     * @Element(name="navy-line")
     * @var NavyLine
     */
    public $navyLine;

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