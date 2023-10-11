<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Stick
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/stick/
 * @Data
 */
class Stick extends MusicXMLWriter
{
	/**
	 * Dashed circle
	 *
	 * @Attribute(name="dashed-circle")
	 * @var string
	 */
	public $dashedCircle;

	/**
	 * Parentheses
	 *
	 * @Attribute(name="parentheses")
	 * @var string
	 */
	public $parentheses;

	/**
	 * Tip
	 *
	 * @Attribute(name="tip")
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