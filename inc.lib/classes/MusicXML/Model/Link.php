<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Link
 * -
 * Link is class of element &lt;link&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;credit&gt;, &lt;measure&gt; (partwise), &lt;part&gt; (timewise)
 * 
 * @Xml
 * @MusicXML
 * @Element(name="link")
 * @ParentElement(name="credit,measure (partwise),part (timewise)")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/link/
 * @Data
 */
class Link extends MusicXMLWriter
{
	/**
	 * Xlink:href
	 * -
	 * The href attribute provides the data that allows an application to find a remote resource or resource fragment. See the 
	 *
	 * @Attribute(name="xlink:href")
	 * @Value(type="anyURI" required="true", allowed="ANY_VALUE")
	 * @var string
	 */
	public $xlinkHref;

	/**
	 * Default x
	 * -
	 * Changes the computation of the default horizontal position. The origin is changed relative to the start of the entire current measure, at either the left barline or the start of the system. Positive x is right and negative x is left.
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
	 * Element
	 * -
	 * The element attribute specifies an element type for a descendant of the next sibling element that is not a &lt;link&gt; or &lt;bookmark&gt; element. When not present, the &lt;bookmark&gt; or &lt;link&gt; element refers to the next sibling element in the MusicXML file.
	 *
	 * @Attribute(name="element")
	 * @Value(type="NMTOKEN" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $element;

	/**
	 * Name
	 * -
	 * The name of this link.
	 *
	 * @Attribute(name="name")
	 * @Value(type="token" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $name;

	/**
	 * Position
	 * -
	 * The position attribute specifies the position of the descendant element specified by the element attribute, where the first position is 1. The position attribute is ignored if the element attribute is not present.
	 *
	 * @Attribute(name="position")
	 * @Value(type="positiveInteger" required="false", min="0", max="infinite")
	 * @var integer
	 */
	public $position;

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
	 * Xlink:actuate
	 * -
	 * The actuate attribute is used to communicate the desired timing of traversal from the starting resource to the ending resource. The default value is onRequest. See the 
	 *
	 * @Attribute(name="xlink:actuate")
	 * @Value(type="xlink:actuate" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $xlinkActuate;

	/**
	 * Xlink:role
	 * -
	 * The role attribute indicates a property of the link. See the 
	 *
	 * @Attribute(name="xlink:role")
	 * @Value(type="token" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $xlinkRole;

	/**
	 * Xlink:show
	 * -
	 * The show attribute is used to communicate the desired presentation of the ending resource on traversal from the starting resource. The default value is replace. See the 
	 *
	 * @Attribute(name="xlink:show")
	 * @Value(type="xlink:show" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $xlinkShow;

	/**
	 * Xlink:title
	 * -
	 * The title attribute describes the meaning of a link or resource in a human-readable fashion. See the 
	 *
	 * @Attribute(name="xlink:title")
	 * @Value(type="token" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $xlinkTitle;

	/**
	 * Xlink:type
	 * -
	 * The type attribute identifies XLink element types. In MusicXML, the value is always simple. See the 
	 *
	 * @Attribute(name="xlink:type")
	 * @Value(type="xlink:type" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $xlinkType;

}