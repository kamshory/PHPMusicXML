<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Beam
 * -
 * Beam is class of element &lt;beam&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;note&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="beam")
 * @ParentElement(name="note")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/beam/
 * @Data
 */
class Beam extends MusicXMLWriter
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
	 * Fan
	 * -
	 * Beams that have a begin value may also have a fan attribute to indicate accelerandos and ritardandos using fanned beams. The fan attribute may also be used with a continue value if the fanning direction changes on that note. The value is none if not specified.
	 *
	 * @Attribute(name="fan")
	 * @Value(type="fan" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $fan;

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
	 * Indicates eighth note through 1024th note beams using number values 1 thru 8 respectively. The default value is 1.
	 *
	 * @Attribute(name="number")
	 * @Value(type="beam-level" required="false", min="-infinite", max="infinite")
	 * @var integer
	 */
	public $number;

	/**
	 * Repeater
	 * -
	 * Deprecated as of Version 3.0. Formerly used for tremolos, it needs to be specified with a &quot;yes&quot; value for each &lt;beam&gt; using it.
	 *
	 * @Attribute(name="repeater")
	 * @Value(type="yes-no" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $repeater;

}