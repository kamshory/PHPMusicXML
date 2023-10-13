<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Extend
 * -
 * Extend is class of element &lt;extend&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;figure&gt;, &lt;lyric&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="extend")
 * @ParentElement(name="figure,lyric")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/extend/
 * @Data
 */
class Extend extends MusicXMLWriter
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
	 * Type
	 * -
	 * Indicates if this is the start, stop, or continuation of the extension. Before Version 3.0 this attribute was not available, and an &lt;extend&gt; element was always treated as the start of the extension.
	 *
	 * @Attribute(name="type")
	 * @Value(type="start-stop-continue" required="false", allowed="start,stop,continue")
	 * @var string
	 */
	public $type;

}