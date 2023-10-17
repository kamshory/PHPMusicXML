<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Direction
 * -
 * Direction is class of element &lt;direction&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;measure&gt; (partwise), &lt;part&gt; (timewise)
 * 
 * @Xml
 * @MusicXML
 * @Element(name="direction")
 * @ParentElement(name="measure (partwise),part (timewise)")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/direction/
 * @Data
 */
class Direction extends MusicXMLWriter
{
	/**
	 * Directive
	 * -
	 * Changes the default-x position of a direction. It indicates that the left-hand side of the direction is aligned with the left-hand side of the time signature. If no time signature is present, the direction is aligned with the left-hand side of the first music notational element in the measure. If a default-x, justify, or halign attribute is present, it overrides this attribute.
	 *
	 * @Attribute(name="directive")
	 * @Value(type="yes-no" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $directive;

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
     * Direction type
     *
     * @Element(name="direction-type")
     * @var DirectionType
     */
    public $directionType;

    /**
     * Staff
     *
     * @Element
     * @var Staff
     */
    public $staff;

    /**
     * Sound
     *
     * @Element
     * @var Sound
     */
    public $sound;
}