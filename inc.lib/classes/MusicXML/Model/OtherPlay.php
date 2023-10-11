<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * OtherPlay
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/other-play/
 * @Data
 */
class OtherPlay extends MusicXMLWriter
{
	/**
	 * Type
	 *
	 * @Attribute(name="type")
	 * @var string
	 */
	public $type;
    
	/**
     * Text content
     *
     * @TextContent
     * @var string
     */
    public $textContent;
}