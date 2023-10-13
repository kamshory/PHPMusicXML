<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Stick
 * -
 * Stick is class of element &lt;stick&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;percussion&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="stick")
 * @ParentElement(name="percussion")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/stick/
 * @Data
 */
class Stick extends MusicXMLWriter
{
	/**
	 * Dashed circle
	 * -
	 * Indicates the presence of a dashed circle around the round beater part of a pictogram. The value is no if not specified.
	 *
	 * @Attribute(name="dashed-circle")
	 * @Value(type="yes-no" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $dashedCircle;

	/**
	 * Parentheses
	 * -
	 * Indicates the presence of parentheses around the round beater part of a pictogram. The value is no if not specified.
	 *
	 * @Attribute(name="parentheses")
	 * @Value(type="yes-no" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $parentheses;

	/**
	 * Tip
	 * -
	 * Represents the direction in which the tip of a stick or beater points, using Unicode arrow terminology.
	 *
	 * @Attribute(name="tip")
	 * @Value(type="tip-direction" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $tip;

	/**
	 * Stick type
	 *
	 * @Element(name="stick-type")
	 * @var StickType
	 */
	public $stickType;

	/**
	 * Stick material
	 *
	 * @Element(name="stick-material")
	 * @var StickMaterial
	 */
	public $stickMaterial;
}