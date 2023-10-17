<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Harmony
 * -
 * Harmony is class of element &lt;harmony&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;measure&gt; (partwise), &lt;part&gt; (timewise)
 * 
 * @Xml
 * @MusicXML
 * @Element(name="harmony")
 * @ParentElement(name="measure (partwise),part (timewise)")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/harmony/
 * @Data
 */
class Harmony extends MusicXMLWriter
{
	/**
	 * Arrangement
	 * -
	 * Specifies how multiple harmony-chords are arranged relative to each other. Harmony-chords with vertical arrangement are separated by horizontal lines. Harmony-chords with diagonal or horizontal arrangement are separated by diagonal lines or slashes.
	 *
	 * @Attribute(name="arrangement")
	 * @Value(type="harmony-arrangement" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $arrangement;

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
	 * Placement
	 * -
	 * Indicates whether something is above or below another element, such as a note or a notation.
	 *
	 * @Attribute(name="placement")
	 * @Value(type="above-below" required="false", allowed="ubove,below")
	 * @var string
	 */
	public $placement;

	/**
	 * Print frame
	 * -
	 * Specifies the printing of a frame or fretboard diagram.
	 *
	 * @Attribute(name="print-frame")
	 * @Value(type="yes-no" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $printFrame;

	/**
	 * Print object
	 * -
	 * Specifies whether or not to print an object. It is yes if not specified.
	 *
	 * @Attribute(name="print-object")
	 * @Value(type="yes-no" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $printObject;

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
	 * System
	 * -
	 * Distinguishes elements that are associated with a system rather than the particular part where the element appears.
	 *
	 * @Attribute(name="system")
	 * @Value(type="system-relation" required="false", allowed="only-top,also-top,none")
	 * @var string
	 */
	public $system;

	/**
	 * Type
	 * -
	 * If there are alternate harmonies possible, this can be specified using multiple &lt;harmony&gt; elements differentiated by type. Explicit harmonies have all note present in the music; implied have some notes missing but implied; alternate represents alternate analyses.
	 *
	 * @Attribute(name="type")
	 * @Value(type="harmony-type" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $type;

    /**
     * Root
     *
     * @Element(name="root")
     * @var Root
     */
    public $root;

    /**
     * Numeral
     *
     * @Element(name="numeral")
     * @var Numeral
     */
    public $numeral;

    /**
     * Function
     *
     * @Element(name="function")
     * @var Function
     */
    public $function;

    /**
     * Kind
     *
     * @Element(name="kind")
     * @var Kind[]
     */
    public $kind;

    /**
     * Inversion
     *
     * @Element(name="inversion")
     * @var Inversion[]
     */
    public $inversion;

    /**
     * Bass
     *
     * @Element(name="bass")
     * @var Bass[]
     */
    public $bass;

    /**
     * Degree
     *
     * @Element(name="degree")
     * @var Degree[]
     */
    public $degree;

    /**
     * Frame
     *
     * @Element(name="frame")
     * @var Frame
     */
    public $frame;

    /**
     * Offset
     *
     * @Element(name="offset")
     * @var Offset
     */
    public $offset;

    /**
     * Footnote
     *
     * @Element(name="footnote")
     * @var Footnote
     */
    public $footnote;

    /**
     * Level
     *
     * @Element(name="level")
     * @var Level
     */
    public $level;

    /**
     * Staff
     *
     * @Element(name="staff")
     * @var Staff
     */
    public $staff;

}