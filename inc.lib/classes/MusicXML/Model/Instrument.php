<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Instrument
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/instrument/
 * @Data
 */
class Instrument extends MusicXMLWriter
{
	/**
	 * Id
	 *
	 * @Attribute(name="id")
	 * @var string
	 */
	public $id;
    
}