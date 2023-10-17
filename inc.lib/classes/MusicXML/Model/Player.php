<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Player
 * -
 * Player is class of element &lt;player&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;score-part&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="player")
 * @ParentElement(name="score-part")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/player/
 * @Data
 */
class Player extends MusicXMLWriter
{
	/**
	 * Id
	 * -
	 * An identifier for this &lt;player&gt; that is unique within this document.
	 *
	 * @Attribute(name="id")
	 * @Value(type="ID" required="true", allowed="ANY_VALUE")
	 * @var string
	 */
	public $id;

	/**
	 * Player name
	 *
	 * @Element(name="player-name")
	 * @var PlayerName
	 */
	public $playerName;
}