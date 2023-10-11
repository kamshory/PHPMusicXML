<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MiscellaneousField
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/miscellaneous-field/
 * @Data
 */
class MiscellaneousField extends MusicXMLWriter
{
	/**
	 * Name
	 *
	 * @Attribute(name="name")
	 * @var string
	 */
	public $name;

	/**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}