<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MeasureStyle
 * -
 * MeasureStyle is class of element &lt;measure-style&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;attributes&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="measure-style")
 * @ParentElement(name="attributes")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/measure-style/
 * @Data
 */
class MeasureStyle extends MusicXMLWriter
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
	 * Number
	 * -
	 * Allows a measure style to apply to only the specified staff in the part. If absent, the measure style applies to all staves in the part.
	 *
	 * @Attribute(name="number")
	 * @Value(type="staff-number" required="false", min="1", max="infinite")
	 * @var integer
	 */
	public $number;

    /**
     * Default X
     *
     * @Attribute(name="default-x")
     * @var float
     */
    public $defaultX;

    /**
     * Default Y
     *
     * @Attribute(name="default-y")
     * @var float
     */
    public $defaultY;

    /**
     * Multiple rest
     *
     * @Element(name="multiple-rest")
     * @var MultipleRest
     */
    public $multipleRest;

    /**
     * Measure repeat
     *
     * @Element(name="measure-repeat")
     * @var MeasureRepeat
     */
    public $measureRepeat;

    /**
     * Beat repeat
     *
     * @Element(name="beat-repeat")
     * @var BeatRepeat
     */
    public $beatRepeat;

    /**
     * Slash
     *
     * @Element
     * @var Slash
     */
    public $slash;

}