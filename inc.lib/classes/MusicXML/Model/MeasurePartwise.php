<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MeasurePartwise
 * -
 * MeasurePartwise is class of element &lt;measure-partwise&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;part&gt; (partwise)
 * 
 * @Xml
 * @MusicXML
 * @Element(name="measure-partwise")
 * @ParentElement(name="part (partwise)")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/measure-partwise/
 * @Data
 */
class MeasurePartwise extends MusicXMLWriter
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
     * Elements of measure
     * -
     * This element tag will exactly match the element name. See annotations of class of each elements. Element of part-timewise consists of:
     * - &lt;note&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/note/
     * - &lt;backup&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/backup/
     * - &lt;forward&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/forward/
     * - &lt;direction&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/direction/
     * - &lt;attributes&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/attributes/
     * - &lt;harmony&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/harmony/
     * - &lt;figured-bass&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/figured-bass/
     * - &lt;print&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/print/
     * - &lt;sound&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/sound/
     * - &lt;listening&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/listening/
     * - &lt;barline&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/barline/
     * - &lt;grouping&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/grouping/
     * - &lt;link&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/link/
     * - &lt;bookmark&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/bookmark/
     *
     * @Element(identification="element")
     * @var MusicXMLWriter[]
     */
    public $elements;

}