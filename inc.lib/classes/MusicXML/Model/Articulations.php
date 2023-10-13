<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Articulations
 * -
 * Articulations is class of element &lt;articulations&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;notations&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="articulations")
 * @ParentElement(name="notations")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/articulations/
 * @Data
 */
class Articulations extends MusicXMLWriter
{
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
     * @Element
     * @var Staccato[]
     */
    public $staccato;

            /**
         * Accent
         *
         * @Element(name="accent")
         * @var Accent[]
         */
        public $accent;

        /**
         * Strong accent
         *
         * @Element(name="strong-accent")
         * @var StrongAccent[]
         */
        public $strongAccent;

        /**
         * Tenuto
         *
         * @Element(name="tenuto")
         * @var Tenuto[]
         */
        public $tenuto;

        /**
         * Detached legato
         *
         * @Element(name="detached-legato")
         * @var DetachedLegato[]
         */
        public $detachedLegato;

        /**
         * Staccatissimo
         *
         * @Element(name="staccatissimo")
         * @var Staccatissimo[]
         */
        public $staccatissimo;

        /**
         * Spiccato
         *
         * @Element(name="spiccato")
         * @var Spiccato[]
         */
        public $spiccato;

        /**
         * Scoop
         *
         * @Element(name="scoop")
         * @var Scoop[]
         */
        public $scoop;

        /**
         * Plop
         *
         * @Element(name="plop")
         * @var Plop[]
         */
        public $plop;

        /**
         * Doit
         *
         * @Element(name="doit")
         * @var Doit[]
         */
        public $doit;

        /**
         * Falloff
         *
         * @Element(name="falloff")
         * @var Falloff[]
         */
        public $falloff;

        /**
         * Breath mark
         *
         * @Element(name="breath-mark")
         * @var BreathMark[]
         */
        public $breathMark;

        /**
         * Caesura
         *
         * @Element(name="caesura")
         * @var Caesura[]
         */
        public $caesura;

        /**
         * Stress
         *
         * @Element(name="stress")
         * @var Stress[]
         */
        public $stress;

        /**
         * Unstress
         *
         * @Element(name="unstress")
         * @var Unstress[]
         */
        public $unstress;

        /**
         * Soft accent
         *
         * @Element(name="soft-accent")
         * @var SoftAccent[]
         */
        public $softAccent;

        /**
         * Other articulation
         *
         * @Element(name="other-articulation")
         * @var OtherArticulation[]
         */
        public $otherArticulation;
}