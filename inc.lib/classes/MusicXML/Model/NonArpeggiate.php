<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * NonArpeggiate
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/non-arpeggiate/
 * @Data
 */
class NonArpeggiate extends MusicXMLWriter
{
	/**
	 * Type
	 *
	 * @Attribute(name="type")
	 * @var string
	 */
	public $type;

	/**
	 * Color
	 *
	 * @Attribute(name="color")
	 * @var string
	 */
	public $color;

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
	 * Id
	 *
	 * @Attribute(name="id")
	 * @var string
	 */
	public $id;

	/**
	 * Number
	 *
	 * @Attribute(name="number")
	 * @var string
	 */
	public $number;

	/**
	 * Placement
	 *
	 * @Attribute(name="placement")
	 * @var string
	 */
	public $placement;

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
    
}