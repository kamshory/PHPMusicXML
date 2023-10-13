<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * InstrumentLink
 * -
 * InstrumentLink is class of element &lt;instrument-link&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;part-link&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="instrument-link")
 * @ParentElement(name="part-link")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/instrument-link/
 * @Data
 */
class InstrumentLink extends MusicXMLWriter
{
	/**
	 * Id
	 * -
	 * Refers to a &lt;score-instrument&gt; id attribute.
	 *
	 * @Attribute(name="id")
	 * @Value(type="IDREF" required="true", allowed="ANY_VALUE")
	 * @var string
	 */
	public $id;

}