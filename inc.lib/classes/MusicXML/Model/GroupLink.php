<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * GroupLink
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/group-link/
 * @Data
 */
class GroupLink extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}