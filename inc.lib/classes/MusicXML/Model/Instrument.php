<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Instrument
 * -
 * Instrument is class of element &lt;instrument&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;note&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="instrument")
 * @ParentElement(name="note")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/instrument/
 * @Data
 */
class Instrument extends MusicXMLWriter
{
	/**
	 * Id
	 * -
	 * An IDREF back to the &lt;score-instrument&gt; id attribute.
	 *
	 * @Attribute(name="id")
	 * @Value(type="IDREF" required="true", allowed="ANY_VALUE")
	 * @var string
	 */
	public $id;

}