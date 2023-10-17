<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Sound
 * -
 * Sound is class of element &lt;sound&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;direction&gt;, &lt;measure&gt; (partwise), &lt;part&gt; (timewise)
 * 
 * @Xml
 * @MusicXML
 * @Element(name="sound")
 * @ParentElement(name="direction,measure (partwise),part (timewise)")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/sound/
 * @Data
 */
class Sound extends MusicXMLWriter
{
	/**
	 * Coda
	 * -
	 * Indicates the end point for a forward jump to a coda sign. If there are multiple jumps, the value of these parameters can be used to name and distinguish them.
	 *
	 * @Attribute(name="coda")
	 * @Value(type="token" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $coda;

	/**
	 * Dacapo
	 * -
	 * Indicates to go back to the beginning of the movement. When used it always has the value &quot;yes&quot;.
	 *
	 * @Attribute(name="dacapo")
	 * @Value(type="yes-no" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $dacapo;

	/**
	 * Dalsegno
	 * -
	 * Indicates the starting point for a backward jump to a segno sign. If there are multiple jumps, the value of these parameters can be used to name and distinguish them.
	 *
	 * @Attribute(name="dalsegno")
	 * @Value(type="token" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $dalsegno;

	/**
	 * Damper pedal
	 * -
	 * Effects playback of the the common right piano pedal and its MIDI controller equivalent. The yes value indicates the pedal is depressed; no indicates the pedal is released. A numeric value from 0 to 100 may also be used for half pedaling. This value is the percentage that the pedal is depressed. A value of 0 is equivalent to no, and a value of 100 is equivalent to yes.
	 *
	 * @Attribute(name="damper-pedal")
	 * @Value(type="yes-no-number" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $damperPedal;

	/**
	 * Divisions
	 * -
	 * If the segno or coda attributes are used, the divisions attribute can be used to indicate the number of divisions per quarter note. Otherwise sound and MIDI generating programs may have to recompute this.
	 *
	 * @Attribute(name="divisions")
	 * @Value(type="divisions" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $divisions;

	/**
	 * Dynamics
	 * -
	 * Dynamics (or MIDI velocity) are expressed as a percentage of the default forte value (90 for MIDI 1.0).
	 *
	 * @Attribute(name="dynamics")
	 * @Value(type="non-negative-decimal" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $dynamics;

	/**
	 * Elevation
	 * -
	 * Allows placing of sound in a 3-D space relative to the listener, expressed in degrees ranging from -180 to 180. 0 is level with the listener, 90 is directly above, and -90 is directly below.
	 *
	 * @Attribute(name="elevation")
	 * @Value(type="rotation-degrees" required="false", min="-180", max="180")
	 * @var float
	 */
	public $elevation;

	/**
	 * Fine
	 * -
	 * Follows the final note or rest in a movement with a da capo or dal segno direction. If numeric, the value represents the actual duration of the final note or rest, which can be ambiguous in written notation and different among parts and voices. The value may also be &quot;yes&quot; to indicate no change to the final duration.
	 *
	 * @Attribute(name="fine")
	 * @Value(type="token" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $fine;

	/**
	 * Forward repeat
	 * -
	 * Indicates that a forward repeat sign is implied but not displayed. It is used for example in two-part forms with repeats, such as a minuet and trio where no repeat is displayed at the start of the trio. This usually occurs after a barline. When used it always has the value of &quot;yes&quot;.
	 *
	 * @Attribute(name="forward-repeat")
	 * @Value(type="yes-no" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $forwardRepeat;

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
	 * Pan
	 * -
	 * Allows placing of sound in a 3-D space relative to the listener, expressed in degrees ranging from -180 to 180. 0 is straight ahead, -90 is hard left, 90 is hard right, and -180 and 180 are directly behind the listener.
	 *
	 * @Attribute(name="pan")
	 * @Value(type="rotation-degrees" required="false", min="-180", max="180")
	 * @var float
	 */
	public $pan;

	/**
	 * Pizzicato
	 * -
	 * Affects all following notes. Yes indicates pizzicato, no indicates arco.
	 *
	 * @Attribute(name="pizzicato")
	 * @Value(type="yes-no" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $pizzicato;

	/**
	 * Segno
	 * -
	 * Indicates the end point for a backward jump to a segno sign. If there are multiple jumps, the value of these parameters can be used to name and distinguish them.
	 *
	 * @Attribute(name="segno")
	 * @Value(type="token" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $segno;

	/**
	 * Soft pedal
	 * -
	 * Effects playback of the the common left piano pedal and its MIDI controller equivalent. The yes value indicates the pedal is depressed; no indicates the pedal is released. A numeric value from 0 to 100 may also be used for half pedaling. This value is the percentage that the pedal is depressed. A value of 0 is equivalent to no, and a value of 100 is equivalent to yes.
	 *
	 * @Attribute(name="soft-pedal")
	 * @Value(type="yes-no-number" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $softPedal;

	/**
	 * Sostenuto pedal
	 * -
	 * Effects playback of the the common center piano pedal and its MIDI controller equivalent. The yes value indicates the pedal is depressed; no indicates the pedal is released. A numeric value from 0 to 100 may also be used for half pedaling. This value is the percentage that the pedal is depressed. A value of 0 is equivalent to no, and a value of 100 is equivalent to yes.
	 *
	 * @Attribute(name="sostenuto-pedal")
	 * @Value(type="yes-no-number" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $sostenutoPedal;

	/**
	 * Tempo
	 * -
	 * Tempo is expressed in quarter notes per minute. If 0, the sound-generating program should prompt the user at the time of compiling a sound (MIDI) file.
	 *
	 * @Attribute(name="tempo")
	 * @Value(type="non-negative-decimal" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $tempo;

	/**
	 * Time only
	 * -
	 * Indicates which times to apply the sound element if the &lt;sound&gt; element applies only particular times through a repeat.
	 *
	 * @Attribute(name="time-only")
	 * @Value(type="time-only" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $timeOnly;

	/**
	 * Tocoda
	 * -
	 * Indicates the starting point for a forward jump to a coda sign. If there are multiple jumps, the value of these parameters can be used to name and distinguish them.
	 *
	 * @Attribute(name="tocoda")
	 * @Value(type="token" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $tocoda;

	/**
	 * Instrument change
	 *
	 * @Element(name="instrument-change")
	 * @var InstrumentChange[]
	 */
	public $instrumentChange;

	/**
	 * Midi device
	 *
	 * @Element(name="midi-device")
	 * @var MidiDevice[]
	 */
	public $midiDevice;

	/**
	 * Midi instrument
	 *
	 * @Element(name="midi-instrument")
	 * @var MidiInstrument[]
	 */
	public $midiInstrument;

	/**
	 * Play
	 *
	 * @Element(name="play")
	 * @var Play[]
	 */
	public $play;

	/**
	 * Swing
	 *
	 * @Element(name="swing")
	 * @var Swing
	 */
	public $swing;

	/**
	 * Offset
	 *
	 * @Element(name="offset")
	 * @var Offset
	 */
	public $offset;

}