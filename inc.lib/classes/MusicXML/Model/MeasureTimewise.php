<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MeasureTimewise
 * -
 * MeasureTimewise is class of element &lt;measure-timewise&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;score-timewise&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="measure-timewise")
 * @ParentElement(name="score-timewise")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/measure-timewise/
 * @Data
 */
class MeasureTimewise extends MusicXMLWriter
{
	/**
	 * Number
	 * -
	 * The attribute that identifies the measure. Going from partwise to timewise, measures are grouped via this attribute. In partwise files, it should be the same for measures in different parts that share the same left barline. 
	 *
	 * @Attribute(name="number")
	 * @Value(type="token" required="true", allowed="ANY_VALUE")
	 * @var string
	 */
	public $number;

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
	 * Implicit
	 * -
	 * Set to &quot;yes&quot; for measures where the measure number should never appear, such as pickup measures and the last half of mid-measure repeats. The value is &quot;no&quot; if not specified.
	 *
	 * @Attribute(name="implicit")
	 * @Value(type="yes-no" required="false", allowed="yes,no")
	 * @var string
	 */
	public $implicit;

	/**
	 * Non controlling
	 * -
	 * Intended for use in multimetric music like the Don Giovanni minuet. If set to &quot;yes&quot;, the left barline in this measure does not coincide with the left barline of measures in other parts. The value is &quot;no&quot; if not specified.
	 *
	 * @Attribute(name="non-controlling")
	 * @Value(type="yes-no" required="false", allowed="yes,no")
	 * @var string
	 */
	public $nonControlling;

	/**
	 * Text
	 * -
	 * If measure numbers are not unique within a part, this can cause problems for conversions between partwise and timewise formats. The text attribute allows specification of displayed measure numbers that are different than what is used in the number attribute. This attribute is ignored for measures where the implicit attribute is set to &quot;yes&quot;. Further details about measure numbering can be specified using the &lt;measure-numbering&gt; element.
	 *
	 * @Attribute(name="text")
	 * @Value(type="measure-text" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $text;

	/**
	 * Width
	 * -
	 * Measure width specified in tenths. These are the global tenths specified in the &lt;scaling&gt; element, not local tenths as modified by the &lt;staff-size&gt; element. The width covers the entire measure from barline or system start to barline or system end.
	 *
	 * @Attribute(name="width")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $width;

	/**
	 * Part timewise
	 *
	 * @Element(name="part")
	 * @var PartTimewise[]
	 */
	public $part;

}