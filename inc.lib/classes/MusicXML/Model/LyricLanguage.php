<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * LyricLanguage
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/lyric-language/
 * @Data
 */
class LyricLanguage extends MusicXMLWriter
{
	/**
	 * Xml:lang
	 *
	 * @Attribute(name="xml:lang")
	 * @var string
	 */
	public $xmlLang;

	/**
	 * Name
	 *
	 * @Attribute(name="name")
	 * @var string
	 */
	public $name;

	/**
	 * Number
	 *
	 * @Attribute(name="number")
	 * @var string
	 */
	public $number;
    
}