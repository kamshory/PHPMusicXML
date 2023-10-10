<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Percussion
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/percussion/
 * @Data
 */
class Percussion extends MusicXMLWriter
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
	 * Enclosure
	 *
	 * @Attribute(name="enclosure")
	 * @var string
	 */
	public $enclosure;

	/**
	 * Font family
	 *
	 * @Attribute(name="font-family")
	 * @var string
	 */
	public $fontFamily;

	/**
	 * Font size
	 *
	 * @Attribute(name="font-size")
	 * @var string
	 */
	public $fontSize;

	/**
	 * Font style
	 *
	 * @Attribute(name="font-style")
	 * @var string
	 */
	public $fontStyle;

	/**
	 * Font weight
	 *
	 * @Attribute(name="font-weight")
	 * @var string
	 */
	public $fontWeight;

	/**
	 * Halign
	 *
	 * @Attribute(name="halign")
	 * @var string
	 */
	public $halign;

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
	 * Valign
	 *
	 * @Attribute(name="valign")
	 * @var string
	 */
	public $valign;
	
	
    /*       
     * Glass
     *
     * @Element(name="glass")
     * @var Glass
     */
    public $glass;

    /*
     * Metal
     *
     * @Element(name="metal")
     * @var Metal
     */
    public $metal;

    /*
     * Wood
     *
     * @Element(name="wood")
     * @var Wood
     */
    public $wood;

    /*
     * Pitched
     *
     * @Element(name="pitched")
     * @var Pitched
     */
    public $pitched;

    /*
     * Membrane
     *
     * @Element(name="membrane")
     * @var Membrane
     */
    public $membrane;

    /*
     * Effect
     *
     * @Element(name="effect")
     * @var Effect
     */
    public $effect;

    /*
     * Timpani
     *
     * @Element(name="timpani")
     * @var Timpani
     */
    public $timpani;

    /*
     * Beater
     *
     * @Element(name="beater")
     * @var Beater
     */
    public $beater;

    /*
     * Stick
     *
     * @Element(name="stick")
     * @var Stick
     */
    public $stick;

    /*
     * Stick location
     *
     * @Element(name="stick-location")
     * @var StickLocation
     */
    public $stickLocation;

    /*
     * Other percussion
     *
     * @Element(name="other-percussion")
     * @var OtherPercussion
     */
    public $otherPercussion;


    
}