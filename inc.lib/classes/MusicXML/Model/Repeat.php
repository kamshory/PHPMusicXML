<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Repeat
 * -
 * Repeat is class of element &lt;repeat&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;barline&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="repeat")
 * @ParentElement(name="barline")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/repeat/
 * @Data
 */
class Repeat extends MusicXMLWriter
{
	/**
	 * Direction
	 * -
	 * The start of the repeat has a forward direction while the end of the repeat has a backward direction.
	 *
	 * @Attribute(name="direction")
	 * @Value(type="backward-forward" required="true", allowed="backward,forward")
	 * @var string
	 */
	public $direction;

	/**
	 * After jump
	 * -
	 * Indicates if the repeats are played after a jump due to a da capo or dal segno. It is only used with backward repeats that are not part of an ending.
	 *
	 * @Attribute(name="after-jump")
	 * @Value(type="yes-no" required="false", allowed="yes,no")
	 * @var string
	 */
	public $afterJump;

	/**
	 * Times
	 * -
	 * Indicates the number of times the repeated section is played. It is only used with backward repeats that are not part of an ending.
	 *
	 * @Attribute(name="times")
	 * @Value(type="nonNegativeInteger" required="false", min="0", max="infinity")
	 * @var integer
	 */
	public $times;

	/**
	 * Winged
	 * -
	 * Indicates whether the repeat has winged extensions that appear above and below the barline.
	 *
	 * @Attribute(name="winged")
	 * @Value(type="winged" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $winged;

}