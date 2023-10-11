<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Play
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/play/
 * @Data
 */
class Play extends MusicXMLWriter
{
	/**
	 * Id
	 *
	 * @Attribute(name="id")
	 * @var string
	 */
	public $id;
	
	/*
	* Ipa
	*
	* @Element(name="ipa")
	* @var Ipa[]
	*/
	public $ipa;

	/*
	* Mute
	*
	* @Element(name="mute")
	* @var Mute[]
	*/
	public $mute;

	/*
	* Semi pitched
	*
	* @Element(name="semi-pitched")
	* @var SemiPitched[]
	*/
	public $semiPitched;

	/*
	* Other play
	*
	* @Element(name="other-play")
	* @var OtherPlay[]
	*/
	public $otherPlay;	
    
}