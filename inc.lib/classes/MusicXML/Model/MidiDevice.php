<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MidiDevice
 * -
 * MidiDevice is class of element &lt;midi-device&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;score-part&gt;, &lt;sound&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="midi-device")
 * @ParentElement(name="score-part,sound")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/midi-device/
 * @Data
 */
class MidiDevice extends MusicXMLWriter
{
	/**
	 * Id
	 * -
	 * Refers to the &lt;score-instrument&gt; assigned to this device. If missing, the device assignment affects all &lt;score-instrument&gt; elements in the &lt;score-part&gt;.
	 *
	 * @Attribute(name="id")
	 * @Value(type="IDREF" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $id;

	/**
	 * Port
	 * -
	 * A number from 1 to 16 that can be used with the unofficial MIDI 1.0 port (or cable) meta event.
	 *
	 * @Attribute(name="port")
	 * @Value(type="midi-16" required="false", min="1", max="16")
	 * @var integer
	 */
	public $port;

    /**
     * Text content
     *
     * @TextContent
     * @var string
     */
    public $textContent = "";

}