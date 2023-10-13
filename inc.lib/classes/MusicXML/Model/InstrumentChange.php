<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * InstrumentChange
 * -
 * InstrumentChange is class of element &lt;instrument-change&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;sound&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="instrument-change")
 * @ParentElement(name="sound")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/instrument-change/
 * @Data
 */
class InstrumentChange extends MusicXMLWriter
{
	/**
	 * Id
	 * -
	 * Refers to the &lt;score-instrument&gt; affected by the change.
	 *
	 * @Attribute(name="id")
	 * @Value(type="IDREF" required="true", allowed="ANY_VALUE")
	 * @var string
	 */
	public $id;

	/**
	 * Instrument sound
	 *
	 * @Element(name="instrument-sound")
	 * @var InstrumentSound
	 */
	public $instrumentSound;

	/**
	 * Solo
	 *
	 * @Element(name="solo")
	 * @var Solo
	 */
	public $solo;

	/**
	 * Ensemble
	 *
	 * @Element(name="ensemble")
	 * @var Ensemble
	 */
	public $ensemble;

}