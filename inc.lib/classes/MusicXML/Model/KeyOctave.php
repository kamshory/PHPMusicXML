<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * KeyOctave
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/key-octave/
 * @Data
 */
class KeyOctave extends MusicXMLWriter
{
	/**
	 * Number
	 *
	 * @Attribute(name="number")
	 * @var string
	 */
	public $number;

	/**
	 * Cancel
	 *
	 * @Attribute(name="cancel")
	 * @var string
	 */
	public $cancel;
    
	/**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}