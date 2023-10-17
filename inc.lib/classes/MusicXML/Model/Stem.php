<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Stem
 * -
 * Stem is class of element &lt;stem&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;note&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="stem")
 * @ParentElement(name="note")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/stem/
 * @Data
 */
class Stem extends MusicXMLWriter
{
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
	 * For down and up stems, changes the computation of the default horizontal position of the end of the stem. The origin is changed relative to the left-hand side of the note. Positive x is right and negative x is left.
	 *
	 * @Attribute(name="default-x")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $defaultX;

	/**
	 * Default y
	 * -
	 * For down and up stems, changes the computation of the default vertical position of the end of the stem. The origin is changed relative to the top line of the staff. Positive y is up and negative y is down.
	 *
	 * @Attribute(name="default-y")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $defaultY;

	/**
	 * Relative x
	 * -
	 * For down and up stems, changes the horizontal position of the end of the stem relative to the default position, either as computed by the individual program, or as overridden by the default-x attribute.  Positive x is right and negative x is left.
	 *
	 * @Attribute(name="relative-x")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $relativeX;

	/**
	 * Relative y
	 * -
	 * For down and up stems, changes the vertical position of the end of the stem relative to the default position, either as computed by the individual program, or as overridden by the default-y attribute. Positive y lengthens a stem while negative y shortens it. Negative values of relative-y that would flip a stem instead of shortening it are ignored.
	 *
	 * @Attribute(name="relative-y")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $relativeY;

	/**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}