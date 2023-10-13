<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * DirectionType
 * -
 * DirectionType is class of element &lt;direction-type&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;direction&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="direction-type")
 * @ParentElement(name="direction")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/direction-type/
 * @Data
 */
class DirectionType extends MusicXMLWriter
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
     * Metronome
     *
     * @Element
     * @var Metronome
     */
    public $metronome;

    /**
     * Rehearsal
     *
     * @Element(name="rehearsal")
     * @var Rehearsal[]
     */
    public $rehearsal;

    /**
     * Segno
     *
     * @Element(name="segno")
     * @var Segno[]
     */
    public $segno;

    /**
     * Coda
     *
     * @Element(name="coda")
     * @var Coda[]
     */
    public $coda;

    /**
     * Words
     *
     * @Element(name="words")
     * @var Words[]
     */
    public $words;

    /**
     * Symbol
     *
     * @Element(name="symbol")
     * @var Symbol[]
     */
    public $symbol;

    /**
     * Wedge
     *
     * @Element(name="wedge")
     * @var Wedge
     */
    public $wedge;

    /**
     * Dynamics
     *
     * @Element(name="dynamics")
     * @var Dynamics[]
     */
    public $dynamics;

    /**
     * Dashes
     *
     * @Element(name="dashes")
     * @var Dashes
     */
    public $dashes;

    /**
     * Bracket
     *
     * @Element(name="bracket")
     * @var Bracket
     */
    public $bracket;

    /**
     * Pedal
     *
     * @Element(name="pedal")
     * @var Pedal
     */
    public $pedal;

    /**
     * Octave shift
     *
     * @Element(name="octave-shift")
     * @var OctaveShift
     */
    public $octaveShift;

    /**
     * Harp pedals
     *
     * @Element(name="harp-pedals")
     * @var HarpPedals
     */
    public $harpPedals;

    /**
     * Damp
     *
     * @Element(name="damp")
     * @var Damp
     */
    public $damp;

    /**
     * Damp all
     *
     * @Element(name="damp-all")
     * @var DampAll
     */
    public $dampAll;

    /**
     * Eyeglasses
     *
     * @Element(name="eyeglasses")
     * @var Eyeglasses
     */
    public $eyeglasses;

    /**
     * String mute
     *
     * @Element(name="string-mute")
     * @var StringMute
     */
    public $stringMute;

    /**
     * Scordatura
     *
     * @Element(name="scordatura")
     * @var Scordatura
     */
    public $scordatura;

    /**
     * Image
     *
     * @Element(name="image")
     * @var Image
     */
    public $image;

    /**
     * Principal voice
     *
     * @Element(name="principal-voice")
     * @var PrincipalVoice
     */
    public $principalVoice;

    /**
     * Percussion
     *
     * @Element(name="percussion")
     * @var Percussion[]
     */
    public $percussion;

    /**
     * Accordion registration
     *
     * @Element(name="accordion-registration")
     * @var AccordionRegistration
     */
    public $accordionRegistration;

    /**
     * Staff divide
     *
     * @Element(name="staff-divide")
     * @var StaffDivide
     */
    public $staffDivide;

    /**
     * Other direction
     *
     * @Element(name="other-direction")
     * @var OtherDirection
     */
    public $otherDirection;
}