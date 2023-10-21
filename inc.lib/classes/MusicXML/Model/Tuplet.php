<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Tuplet
 * -
 * Tuplet is class of element &lt;tuplet&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;notations&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="tuplet")
 * @ParentElement(name="notations")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/tuplet/
 * @Data
 */
class Tuplet extends MusicXMLWriter
{
	/**
	 * Type
	 * -
	 * Indicates if this is the start or stop of the tuplet.
	 *
	 * @Attribute(name="type")
	 * @Value(type="start-stop" required="true", allowed="start,stop")
	 * @var string
	 */
	public $type;

	/**
	 * Bracket
	 * -
	 * Indicates the presence of a bracket. If unspecified, the result is implementation-dependent.
	 *
	 * @Attribute(name="bracket")
	 * @Value(type="yes-no" required="false", allowed="yes,no")
	 * @var string
	 */
	public $bracket;

	/**
	 * Default x
	 * -
	 * Changes the computation of the default horizontal position. The origin is changed relative to the left-hand side of the note or the musical position within the bar. Positive x is right and negative x is left.
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
	 * Line shape
	 * -
	 * Used to specify whether the bracket is straight or in the older curved or slurred style. It is straight if not specified.
	 *
	 * @Attribute(name="line-shape")
	 * @Value(type="line-shape" required="false", allowed="straight,curved")
	 * @var string
	 */
	public $lineShape;

	/**
	 * Number
	 * -
	 * Distinguishes nested tuplets.
	 *
	 * @Attribute(name="number")
	 * @Value(type="number-level" required="false", min="-infinite", max="infinite")
	 * @var integer
	 */
	public $number;

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
	 * Show number
	 * -
	 * Used to display either the number of actual notes, the number of both actual and normal notes, or neither. It is actual if not specified.
	 *
	 * @Attribute(name="show-number")
	 * @Value(type="show-tuplet" required="false", allowed="actual,both,none")
	 * @var string
	 */
	public $showNumber;

	/**
	 * Show type
	 * -
	 * Used to display either the actual type, both the actual and normal types, or neither. It is none if not specified.
	 *
	 * @Attribute(name="show-type")
	 * @Value(type="show-tuplet" required="false", allowed="actual,both,none")
	 * @var string
	 */
	public $showType;

    /**
     * Tuplet actual
     *
     * @Element
     * @var TupletActual
     */
    public $tupletActual;

    /**
     * Tuplet normal
     *
     * @Element
     * @var TupletNormal
     */
    public $tupletNormal;
}