<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Grouping
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/grouping/
 * @Data
 */
class Grouping extends MusicXMLWriter
{
	/**
	 * Type
	 *
	 * @Attribute(name="type")
	 * @var string
	 */
	public $type;

	/**
	 * Id
	 *
	 * @Attribute(name="id")
	 * @var string
	 */
	public $id;

	/**
	 * Member of
	 *
	 * @Attribute(name="member-of")
	 * @var string
	 */
	public $memberOf;

	/**
	 * Number
	 *
	 * @Attribute(name="number")
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