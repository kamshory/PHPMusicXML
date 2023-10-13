<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Grouping
 * -
 * Grouping is class of element &lt;grouping&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;measure&gt; (partwise), &lt;part&gt; (timewise)
 * 
 * @Xml
 * @MusicXML
 * @Element(name="grouping")
 * @ParentElement(name="measure (partwise),part (timewise)")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/grouping/
 * @Data
 */
class Grouping extends MusicXMLWriter
{
	/**
	 * Type
	 * -
	 * Indicates if this is a single-note grouping, or the start or stop of a multi-note grouping.
	 *
	 * @Attribute(name="type")
	 * @Value(type="start-stop-single" required="true", allowed="start,stop,single")
	 * @var string
	 */
	public $type;

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
	 * Member of
	 * -
	 * Distinguishes which &lt;grouping&gt; elements are in which hierarchy.
	 *
	 * @Attribute(name="member-of")
	 * @Value(type="token" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $memberOf;

	/**
	 * Number
	 * -
	 * Distinguishes between various overlapping and hierarchical groupings. The default value is 1.
	 *
	 * @Attribute(name="number")
	 * @Value(type="token" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $number;

	/**
	 * Feature
	 *
	 * @element(name="feature")
	 * @var Feature
	 */
	public $feature;

}