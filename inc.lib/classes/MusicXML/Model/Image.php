<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Image
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/image/
 * @Data
 */
class Image extends MusicXMLWriter
{
	/**
	 * Source
	 *
	 * @Attribute(name="source")
	 * @var string
	 */
	public $source;

	/**
	 * Type
	 *
	 * @Attribute(name="type")
	 * @var string
	 */
	public $type;

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
	 * Halign
	 *
	 * @Attribute(name="halign")
	 * @var string
	 */
	public $halign;

	/**
	 * Height
	 *
	 * @Attribute(name="height")
	 * @var string
	 */
	public $height;

	/**
	 * Id
	 *
	 * @Attribute(name="id")
	 * @var string
	 */
	public $id;

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
	 * Valign
	 *
	 * @Attribute(name="valign")
	 * @var string
	 */
	public $valign;

	/**
	 * Width
	 *
	 * @Attribute(name="width")
	 * @var string
	 */
	public $width;
    
}