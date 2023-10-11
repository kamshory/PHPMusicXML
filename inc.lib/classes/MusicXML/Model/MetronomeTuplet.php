<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MetronomeTuplet
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/metronome-tuplet/
 * @Data
 */
class MetronomeTuplet extends MusicXMLWriter
{
	/**
	 * Type
	 *
	 * @Attribute(name="type")
	 * @var string
	 */
	public $type;

	/**
	 * Bracket
	 *
	 * @Attribute(name="bracket")
	 * @var string
	 */
	public $bracket;

	/**
	 * Show number
	 *
	 * @Attribute(name="show-number")
	 * @var string
	 */
	public $showNumber;
    
	/**
     * Actual notes
     *
     * @Element(name="actual-notes")
     * @var ActualNotes
     */
    public $actualNotes;

    /**
     * Normal notes
     *
     * @Element(name="normal-notes")
     * @var NormalNotes
     */
    public $normalNotes;

    /**
     * Normal type
     *
     * @Element(name="normal-type")
     * @var NormalType
     */
    public $normalType;

    /**
     * Normal dot
     *
     * @Element(name="normal-dot")
     * @var NormalDot[]
     */
    public $normalDot;

}