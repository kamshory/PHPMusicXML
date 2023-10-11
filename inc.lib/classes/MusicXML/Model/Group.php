<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Group
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/group/
 * @Data
 */
class Group extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}