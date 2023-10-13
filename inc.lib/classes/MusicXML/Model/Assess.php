<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Assess
 * -
 * Assess is class of element &lt;assess&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;listen&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="assess")
 * @ParentElement(name="listen")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/assess/
 * @Data
 */
class Assess extends MusicXMLWriter
{
	/**
	 * Type
	 * -
	 * If yes, the note should be assessed; if no, it should not be assessed. If not specified, it is no for notes with a &lt;cue&gt; child element and yes otherwise.
	 *
	 * @Attribute(name="type")
	 * @Value(type="yes-no" required="true", allowed="ANY_VALUE")
	 * @var string
	 */
	public $type;

	/**
	 * Player
	 * -
	 * Restricts the type to apply to a single player. If missing, the type applies to all players. It references the id attribute of a &lt;player&gt; element defined within the matching &lt;score-part&gt;.
	 *
	 * @Attribute(name="player")
	 * @Value(type="IDREF" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $player;

	/**
	 * Time only
	 * -
	 * Restricts the type to apply to a set of times through a repeated section. If missing, the type applies all times through the repeated section.
	 *
	 * @Attribute(name="time-only")
	 * @Value(type="time-only" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $timeOnly;

}