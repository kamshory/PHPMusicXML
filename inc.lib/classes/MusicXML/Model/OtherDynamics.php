<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * OtherDynamics
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/other-dynamics/
 * @Data
 */
class OtherDynamics extends MusicXMLWriter
{
	/**
	 * Smufl
	 *
	 * @Attribute(name="smufl")
	 * @var string
	 */
	public $smufl;
    
}