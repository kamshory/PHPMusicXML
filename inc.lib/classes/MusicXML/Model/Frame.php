<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Frame
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/frame/
 * @Data
 */
class Frame extends MusicXMLWriter
{
	/**
	 * Color
	 *
	 * @Attribute(name="color")
	 * @var string
	 */
	public $color;

	/**
	 * Default x
	 *
	 * @Attribute(name="default-x")
	 * @var float
	 */
	public $defaultX;

	/**
	 * Default y
	 *
	 * @Attribute(name="default-y")
	 * @var float
	 */
	public $defaultY;

	/**
	 * Halign
	 *
	 * @Attribute(name="halign")
	 * @var string
	 */
	public $halign;

	/**
	 * Height
	 *
	 * @Attribute(name="height")
	 * @var string
	 */
	public $height;

	/**
	 * Id
	 *
	 * @Attribute(name="id")
	 * @var string
	 */
	public $id;

	/**
	 * Relative x
	 *
	 * @Attribute(name="relative-x")
	 * @var float
	 */
	public $relativeX;

	/**
	 * Relative y
	 *
	 * @Attribute(name="relative-y")
	 * @var float
	 */
	public $relativeY;

	/**
	 * Unplayed
	 *
	 * @Attribute(name="unplayed")
	 * @var string
	 */
	public $unplayed;

	/**
	 * Valign
	 *
	 * @Attribute(name="valign")
	 * @var string
	 */
	public $valign;

	/**
	 * Width
	 *
	 * @Attribute(name="width")
	 * @var string
	 */
	public $width;
    
    /**
     * Frame strings
     *
     * @Element(name="frame-strings")
     * @var FrameStrings
     */
    public $frameStrings;

    /**
     * Frame frets
     *
     * @Element(name="frame-frets")
     * @var FrameFrets
     */
    public $frameFrets;

    /**
     * First fret
     *
     * @Element(name="first-fret")
     * @var FirstFret
     */
    public $firstFret;

    /**
     * Frame note
     *
     * @Element(name="frame-note")
     * @var FrameNote[]
     */
    public $frameNote;

}