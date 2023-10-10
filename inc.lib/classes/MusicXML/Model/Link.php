<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Link
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/link/
 * @Data
 */
class Link extends MusicXMLWriter
{
	/**
	 * Xlink:href
	 *
	 * @Attribute(name="xlink:href")
	 * @var string
	 */
	public $xlinkHref;

	/**
	 * Default x
	 *
	 * @Attribute(name="default-x")
	 * @var float
	 */
	public $defaultX;

	/**
	 * Default y
	 *
	 * @Attribute(name="default-y")
	 * @var float
	 */
	public $defaultY;

	/**
	 * Element
	 *
	 * @Attribute(name="element")
	 * @var string
	 */
	public $element;

	/**
	 * Name
	 *
	 * @Attribute(name="name")
	 * @var string
	 */
	public $name;

	/**
	 * Position
	 *
	 * @Attribute(name="position")
	 * @var string
	 */
	public $position;

	/**
	 * Relative x
	 *
	 * @Attribute(name="relative-x")
	 * @var float
	 */
	public $relativeX;

	/**
	 * Relative y
	 *
	 * @Attribute(name="relative-y")
	 * @var float
	 */
	public $relativeY;

	/**
	 * Xlink:actuate
	 *
	 * @Attribute(name="xlink:actuate")
	 * @var string
	 */
	public $xlinkActuate;

	/**
	 * Xlink:role
	 *
	 * @Attribute(name="xlink:role")
	 * @var string
	 */
	public $xlinkRole;

	/**
	 * Xlink:show
	 *
	 * @Attribute(name="xlink:show")
	 * @var string
	 */
	public $xlinkShow;

	/**
	 * Xlink:title
	 *
	 * @Attribute(name="xlink:title")
	 * @var string
	 */
	public $xlinkTitle;

	/**
	 * Xlink:type
	 *
	 * @Attribute(name="xlink:type")
	 * @var string
	 */
	public $xlinkType;
    
}