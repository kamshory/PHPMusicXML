<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * KeyOctave
 * -
 * KeyOctave is class of element &lt;key-octave&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;key&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="key-octave")
 * @ParentElement(name="key")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/key-octave/
 * @Data
 */
class KeyOctave extends MusicXMLWriter
{
	/**
	 * Number
	 * -
	 * A positive integer that refers to the key signature element in left-to-right order.
	 *
	 * @Attribute(name="number")
	 * @Value(type="positiveInteger" required="true", min="0", max="infinite")
	 * @var integer
	 */
	public $number;

	/**
	 * Cancel
	 * -
	 * If set to yes, then the number refers to the canceling key signature specified by the &lt;cancel&gt; element in the parent &lt;key&gt; element. It cannot be set to yes if there is no corresponding &lt;cancel&gt; element within the parent &lt;key&gt; element. It is no if absent.
	 *
	 * @Attribute(name="cancel")
	 * @Value(type="yes-no" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $cancel;

	/**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}