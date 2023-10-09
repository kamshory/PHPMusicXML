<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Dynamics
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/dynamics/
 * @Data
 */
class Dynamics extends MusicXMLWriter
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
	 * Line through
	 *
	 * @Attribute(name="line-through")
	 * @var string
	 */
	public $lineThrough;

	/**
	 * Overline
	 *
	 * @Attribute(name="overline")
	 * @var string
	 */
	public $overline;

	/**
	 * Placement
	 *
	 * @Attribute(name="placement")
	 * @var string
	 */
	public $placement;

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
	 * Underline
	 *
	 * @Attribute(name="underline")
	 * @var string
	 */
	public $underline;

	/**
	 * Valign
	 *
	 * @Attribute(name="valign")
	 * @var string
	 */
	public $valign;
	
	        /*
         * P
         *
         * @Element(name="p")
         * @var P[]
         */
        public $p;

        /*
         * Pp
         *
         * @Element(name="pp")
         * @var Pp[]
         */
        public $pp;

        /*
         * Ppp
         *
         * @Element(name="ppp")
         * @var Ppp[]
         */
        public $ppp;

        /*
         * Pppp
         *
         * @Element(name="pppp")
         * @var Pppp[]
         */
        public $pppp;

        /*
         * Ppppp
         *
         * @Element(name="ppppp")
         * @var Ppppp[]
         */
        public $ppppp;

        /*
         * Pppppp
         *
         * @Element(name="pppppp")
         * @var Pppppp[]
         */
        public $pppppp;

        /*
         * F
         *
         * @Element(name="f")
         * @var F[]
         */
        public $f;

        /*
         * Ff
         *
         * @Element(name="ff")
         * @var Ff[]
         */
        public $ff;

        /*
         * Fff
         *
         * @Element(name="fff")
         * @var Fff[]
         */
        public $fff;

        /*
         * Ffff
         *
         * @Element(name="ffff")
         * @var Ffff[]
         */
        public $ffff;

        /*
         * Fffff
         *
         * @Element(name="fffff")
         * @var Fffff[]
         */
        public $fffff;

        /*
         * Ffffff
         *
         * @Element(name="ffffff")
         * @var Ffffff[]
         */
        public $ffffff;

        /*
         * Mp
         *
         * @Element(name="mp")
         * @var Mp[]
         */
        public $mp;

        /*
         * Mf
         *
         * @Element(name="mf")
         * @var Mf[]
         */
        public $mf;

        /*
         * Sf
         *
         * @Element(name="sf")
         * @var Sf[]
         */
        public $sf;

        /*
         * Sfp
         *
         * @Element(name="sfp")
         * @var Sfp[]
         */
        public $sfp;

        /*
         * Sfpp
         *
         * @Element(name="sfpp")
         * @var Sfpp[]
         */
        public $sfpp;

        /*
         * Fp
         *
         * @Element(name="fp")
         * @var Fp[]
         */
        public $fp;

        /*
         * Rf
         *
         * @Element(name="rf")
         * @var Rf[]
         */
        public $rf;

        /*
         * Rfz
         *
         * @Element(name="rfz")
         * @var Rfz[]
         */
        public $rfz;

        /*
         * Sfz
         *
         * @Element(name="sfz")
         * @var Sfz[]
         */
        public $sfz;

        /*
         * Sffz
         *
         * @Element(name="sffz")
         * @var Sffz[]
         */
        public $sffz;

        /*
         * Fz
         *
         * @Element(name="fz")
         * @var Fz[]
         */
        public $fz;

        /*
         * N
         *
         * @Element(name="n")
         * @var N[]
         */
        public $n;

        /*
         * Pf
         *
         * @Element(name="pf")
         * @var Pf[]
         */
        public $pf;

        /*
         * Sfzp
         *
         * @Element(name="sfzp")
         * @var Sfzp[]
         */
        public $sfzp;

        /*
         * Other dynamics
         *
         * @Element(name="other-dynamics")
         * @var OtherDynamics[]
         */
        public $otherDynamics;
    
}