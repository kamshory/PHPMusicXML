<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Scordatura
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/scordatura/
 * @Data
 */
class Scordatura extends MusicXMLWriter
{
	/**
	 * Id
	 *
	 * @Attribute(name="id")
	 * @var string
	 */
	public $id;
    
}