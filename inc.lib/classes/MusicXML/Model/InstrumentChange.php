<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * InstrumentChange
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/instrument-change/
 * @Data
 */
class InstrumentChange extends MusicXMLWriter
{
	/**
	 * Id
	 *
	 * @Attribute(name="id")
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