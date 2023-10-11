<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Time
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/time/
 * @Data
 */
class Time extends MusicXMLWriter
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
	 * Number
	 *
	 * @Attribute(name="number")
	 * @var string
	 */
	public $number;

	/**
	 * Print object
	 *
	 * @Attribute(name="print-object")
	 * @var string
	 */
	public $printObject;

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
	 * Valign
	 *
	 * @Attribute(name="valign")
	 * @var string
	 */
	public $valign;
    
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
	
	/*
     * Interchangeable
     *
     * @Element(name="interchangeable")
     * @var Interchangeable
     */
    public $interchangeable;

    /**
     * Senza misura
     *
     * @Element(name="senza-misura ")
     * @var SenzaMisura
     */
    public $senzaMisura;

}