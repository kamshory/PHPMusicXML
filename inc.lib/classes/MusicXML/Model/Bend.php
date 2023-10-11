<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Bend
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/bend/
 * @Data
 */
class Bend extends MusicXMLWriter
{
	/**
	 * Accelerate
	 *
	 * @Attribute(name="accelerate")
	 * @var string
	 */
	public $accelerate;

	/**
	 * Beats
	 *
	 * @Attribute(name="beats")
	 * @var string
	 */
	public $beats;

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
	 * First beat
	 *
	 * @Attribute(name="first-beat")
	 * @var float
	 */
	public $firstBeat;

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
	 * Last beat
	 *
	 * @Attribute(name="last-beat")
	 * @var string
	 */
	public $lastBeat;

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
	 * Shape
	 *
	 * @Attribute(name="shape")
	 * @var string
	 */
	public $shape;
	
	/**
	 * Bend alter
	 *
	 * @Element(name="bend-alter")
	 * @var BendAlter
	 */
	public $bendAlter;
	
	/**
	 * Pre bend
	 *
	 * @Element(name="pre-bend")
	 * @var PreBend[]
	 */
	public $preBend;
	
	/**
	 * Release
	 *
	 * @Element(name="release")
	 * @var Release[]
	 */
	public $release;
    
	/**
	 * With bar
	 *
	 * @Element(name="with-bar")
	 * @var WithBar
	 */
	public $withBar;
}