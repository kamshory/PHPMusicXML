<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Interchangeable
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/interchangeable/
 * @Data
 */
class Interchangeable extends MusicXMLWriter
{
	/**
	 * Separator
	 *
	 * @Attribute(name="separator")
	 * @var string
	 */
	public $separator;

	/**
	 * Symbol
	 *
	 * @Attribute(name="symbol")
	 * @var string
	 */
	public $symbol;
	
	/**
     * Time relation
     *
     * @Element(name="time-relation")
     * @var TimeRelation
     */
    public $timeRelation;
    
	/**
     * Beats
     *
     * @Element(name="beats")
     * @var Beats[]
     */
    public $beats;
    
    /**
     * BeatType
     *
     * @PropertyElement(name="beat-type")
     * @var BeatType[]
     */
    public $beatType;
}