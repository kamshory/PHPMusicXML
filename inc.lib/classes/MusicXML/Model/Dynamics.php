<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Dynamics
 * -
 * Dynamics is class of element &lt;dynamics&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;direction-type&gt;, &lt;notations&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="dynamics")
 * @ParentElement(name="direction-type,notations")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/dynamics/
 * @Data
 */
class Dynamics extends MusicXMLWriter
{
	/**
	 * Color
	 * -
	 * Indicates the color of an element.
	 *
	 * @Attribute(name="color")
	 * @Value(type="color" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $color;

	/**
	 * Default x
	 * -
	 * Changes the computation of the default horizontal position. The origin is changed relative to the left-hand side of the note or the musical position within the bar. Positive x is right and negative x is left.
	 *
	 * @Attribute(name="default-x")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $defaultX;

	/**
	 * Default y
	 * -
	 * Changes the computation of the default vertical position. The origin is changed relative to the top line of the staff. Positive y is up and negative y is down.
	 *
	 * @Attribute(name="default-y")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $defaultY;

	/**
	 * Enclosure
	 * -
	 * Formatting of an enclosure around text or symbols.
	 *
	 * @Attribute(name="enclosure")
	 * @Value(type="enclosure-shape" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $enclosure;

	/**
	 * Font family
	 * -
	 * A comma-separated list of font names.
	 *
	 * @Attribute(name="font-family")
	 * @Value(type="font-family" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $fontFamily;

	/**
	 * Font size
	 * -
	 * One of the CSS sizes or a numeric point size.
	 *
	 * @Attribute(name="font-size")
	 * @Value(type="font-size" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $fontSize;

	/**
	 * Font style
	 * -
	 * Normal or italic style.
	 *
	 * @Attribute(name="font-style")
	 * @Value(type="font-style" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $fontStyle;

	/**
	 * Font weight
	 * -
	 * Normal or bold weight.
	 *
	 * @Attribute(name="font-weight")
	 * @Value(type="font-weight" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $fontWeight;

	/**
	 * Halign
	 * -
	 * In cases where text extends over more than one line, horizontal alignment and justify values can be different. The most typical case is for credits, such as:
	 *
	 * @Attribute(name="halign")
	 * @Value(type="left-center-right" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $halign;

	/**
	 * Id
	 * -
	 * Specifies an ID that is unique to the entire document.
	 *
	 * @Attribute(name="id")
	 * @Value(type="ID" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $id;

	/**
	 * Line through
	 * -
	 * Number of lines to use when striking through text.
	 *
	 * @Attribute(name="line-through")
	 * @Value(type="number-of-lines" required="false", min="-infinite", max="infinite")
	 * @var integer
	 */
	public $lineThrough;

	/**
	 * Overline
	 * -
	 * Number of lines to use when overlining text.
	 *
	 * @Attribute(name="overline")
	 * @Value(type="number-of-lines" required="false", min="-infinite", max="infinite")
	 * @var integer
	 */
	public $overline;

	/**
	 * Placement
	 * -
	 * Indicates whether something is above or below another element, such as a note or a notation.
	 *
	 * @Attribute(name="placement")
	 * @Value(type="above-below" required="false", allowed="ubove,below")
	 * @var string
	 */
	public $placement;

	/**
	 * Relative x
	 * -
	 * Changes the horizontal position relative to the default position, either as computed by the individual program, or as overridden by the default-x attribute.  Positive x is right and negative x is left. It should be interpreted in the context of the &lt;offset&gt; element or directive attribute if those are present.
	 *
	 * @Attribute(name="relative-x")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $relativeX;

	/**
	 * Relative y
	 * -
	 * Changes the vertical position relative to the default position, either as computed by the individual program, or as overridden by the default-y attribute. Positive y is up and negative y is down. It should be interpreted in the context of the placement attribute if that is present.
	 *
	 * @Attribute(name="relative-y")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $relativeY;

	/**
	 * Underline
	 * -
	 * Number of lines to use when underlining text.
	 *
	 * @Attribute(name="underline")
	 * @Value(type="number-of-lines" required="false", min="-infinite", max="infinite")
	 * @var integer
	 */
	public $underline;

	/**
	 * Valign
	 * -
	 * Indicates vertical alignment to the top, middle, bottom, or baseline of the text. The default is implementation-dependent.
	 *
	 * @Attribute(name="valign")
	 * @Value(type="valign" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $valign;

	/**
         * P
         *
         * @Element(name="p")
         * @var P[]
         */
        public $p;

        /**
         * Pp
         *
         * @Element(name="pp")
         * @var Pp[]
         */
        public $pp;

        /**
         * Ppp
         *
         * @Element(name="ppp")
         * @var Ppp[]
         */
        public $ppp;

        /**
         * Pppp
         *
         * @Element(name="pppp")
         * @var Pppp[]
         */
        public $pppp;

        /**
         * Ppppp
         *
         * @Element(name="ppppp")
         * @var Ppppp[]
         */
        public $ppppp;

        /**
         * Pppppp
         *
         * @Element(name="pppppp")
         * @var Pppppp[]
         */
        public $pppppp;

        /**
         * F
         *
         * @Element(name="f")
         * @var F[]
         */
        public $f;

        /**
         * Ff
         *
         * @Element(name="ff")
         * @var Ff[]
         */
        public $ff;

        /**
         * Fff
         *
         * @Element(name="fff")
         * @var Fff[]
         */
        public $fff;

        /**
         * Ffff
         *
         * @Element(name="ffff")
         * @var Ffff[]
         */
        public $ffff;

        /**
         * Fffff
         *
         * @Element(name="fffff")
         * @var Fffff[]
         */
        public $fffff;

        /**
         * Ffffff
         *
         * @Element(name="ffffff")
         * @var Ffffff[]
         */
        public $ffffff;

        /**
         * Mp
         *
         * @Element(name="mp")
         * @var Mp[]
         */
        public $mp;

        /**
         * Mf
         *
         * @Element(name="mf")
         * @var Mf[]
         */
        public $mf;

        /**
         * Sf
         *
         * @Element(name="sf")
         * @var Sf[]
         */
        public $sf;

        /**
         * Sfp
         *
         * @Element(name="sfp")
         * @var Sfp[]
         */
        public $sfp;

        /**
         * Sfpp
         *
         * @Element(name="sfpp")
         * @var Sfpp[]
         */
        public $sfpp;

        /**
         * Fp
         *
         * @Element(name="fp")
         * @var Fp[]
         */
        public $fp;

        /**
         * Rf
         *
         * @Element(name="rf")
         * @var Rf[]
         */
        public $rf;

        /**
         * Rfz
         *
         * @Element(name="rfz")
         * @var Rfz[]
         */
        public $rfz;

        /**
         * Sfz
         *
         * @Element(name="sfz")
         * @var Sfz[]
         */
        public $sfz;

        /**
         * Sffz
         *
         * @Element(name="sffz")
         * @var Sffz[]
         */
        public $sffz;

        /**
         * Fz
         *
         * @Element(name="fz")
         * @var Fz[]
         */
        public $fz;

        /**
         * N
         *
         * @Element(name="n")
         * @var N[]
         */
        public $n;

        /**
         * Pf
         *
         * @Element(name="pf")
         * @var Pf[]
         */
        public $pf;

        /**
         * Sfzp
         *
         * @Element(name="sfzp")
         * @var Sfzp[]
         */
        public $sfzp;

        /**
         * Other dynamics
         *
         * @Element(name="other-dynamics")
         * @var OtherDynamics[]
         */
        public $otherDynamics;
}