<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Play
 * -
 * Play is class of element &lt;play&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;note&gt;, &lt;sound&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="play")
 * @ParentElement(name="note,sound")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/play/
 * @Data
 */
class Play extends MusicXMLWriter
{
	/**
	 * Id
	 * -
	 * Refers to a specific &lt;score-instrument&gt; to which this playback applies.
	 *
	 * @Attribute(name="id")
	 * @Value(type="IDREF" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $id;

	/**
	* Ipa
	*
	* @Element(name="ipa")
	* @var Ipa[]
	*/
	public $ipa;

	/**
	* Mute
	*
	* @Element(name="mute")
	* @var Mute[]
	*/
	public $mute;

	/**
	* Semi pitched
	*
	* @Element(name="semi-pitched")
	* @var SemiPitched[]
	*/
	public $semiPitched;

	/**
	* Other play
	*
	* @Element(name="other-play")
	* @var OtherPlay[]
	*/
	public $otherPlay;

}