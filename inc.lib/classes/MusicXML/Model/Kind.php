<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Kind
 * -
 * Kind is class of element &lt;kind&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;harmony&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="kind")
 * @ParentElement(name="harmony")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/kind/
 * @Data
 */
class Kind extends MusicXMLWriter
{
	/**
	 * Bracket degrees
	 * -
	 * The bracket-degrees attribute is yes if all the degrees should be in a bracket. The default is implementation-dependent.
	 *
	 * @Attribute(name="bracket-degrees")
	 * @Value(type="yes-no" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $bracketDegrees;

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
	 * Halign
	 * -
	 * In cases where text extends over more than one line, horizontal alignment and justify values can be different. The most typical case is for credits, such as:
	 *
	 * @Attribute(name="halign")
	 * @Value(type="left-center-right" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $halign;

	/**
	 * Parentheses degrees
	 * -
	 * The parentheses-degrees attribute is yes if all the degrees should be in parentheses. The default is implementation-dependent.
	 *
	 * @Attribute(name="parentheses-degrees")
	 * @Value(type="yes-no" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $parenthesesDegrees;

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
	 * Stack degrees
	 * -
	 * If yes, the &lt;degree&gt; elements should be stacked above each other. The default is implementation-dependent.
	 *
	 * @Attribute(name="stack-degrees")
	 * @Value(type="yes-no" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $stackDegrees;

	/**
	 * Text
	 * -
	 * Describes how the &lt;kind&gt; should be spelled in a score. If the use-symbols attribute is yes, this value follows the symbol. The default is implementation-dependent.
	 *
	 * @Attribute(name="text")
	 * @Value(type="token" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $text;

	/**
	 * Use symbols
	 * -
	 * The use-symbols attribute is yes if the &lt;kind&gt; should be represented when possible with harmony symbols rather than letters and numbers. These symbols include:
	 *
	 * @Attribute(name="use-symbols")
	 * @Value(type="yes-no" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $useSymbols;

	/**
	 * Valign
	 * -
	 * Indicates vertical alignment to the top, middle, bottom, or baseline of the text. The default is implementation-dependent.
	 *
	 * @Attribute(name="valign")
	 * @Value(type="valign" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $valign;

	/**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}