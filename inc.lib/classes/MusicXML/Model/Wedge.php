<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Wedge
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/wedge/
 * @Data
 */
class Wedge extends MusicXMLWriter
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
	 * Dash length
	 *
	 * @Attribute(name="dash-length")
	 * @var float
	 */
	public $dashLength;

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
	 * Line type
	 *
	 * @Attribute(name="line-type")
	 * @var string
	 */
	public $lineType;

	/**
	 * Niente
	 *
	 * @Attribute(name="niente")
	 * @var string
	 */
	public $niente;

	/**
	 * Number
	 *
	 * @Attribute(name="number")
	 * @var string
	 */
	public $number;

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
	 * Space length
	 *
	 * @Attribute(name="space-length")
	 * @var float
	 */
	public $spaceLength;

	/**
	 * Spread
	 *
	 * @Attribute(name="spread")
	 * @var string
	 */
	public $spread;
    
}