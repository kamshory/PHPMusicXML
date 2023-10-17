<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Bookmark
 * -
 * Bookmark is class of element &lt;bookmark&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;credit&gt;, &lt;measure&gt; (partwise), &lt;part&gt; (timewise)
 * 
 * @Xml
 * @MusicXML
 * @Element(name="bookmark")
 * @ParentElement(name="credit,measure (partwise),part (timewise)")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/bookmark/
 * @Data
 */
class Bookmark extends MusicXMLWriter
{
	/**
	 * Id
	 * -
	 * The identifier for this bookmark, unique within this document.
	 *
	 * @Attribute(name="id")
	 * @Value(type="ID" required="true", allowed="ANY_VALUE")
	 * @var string
	 */
	public $id;

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
	 * The name for this bookmark.
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

}