<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * InstrumentLink
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/instrument-link/
 * @Data
 */
class InstrumentLink extends MusicXMLWriter
{
	/**
	 * Id
	 *
	 * @Attribute(name="id")
	 * @var string
	 */
	public $id;
    
}