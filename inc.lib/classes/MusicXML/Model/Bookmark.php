<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Bookmark
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/bookmark/
 * @Data
 */
class Bookmark extends MusicXMLWriter
{
	/**
	 * Id
	 *
	 * @Attribute(name="id")
	 * @var string
	 */
	public $id;

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
    
}