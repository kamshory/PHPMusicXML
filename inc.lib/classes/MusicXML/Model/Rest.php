<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Rest
 * -
 * Rest is class of element &lt;rest&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;note&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="rest")
 * @ParentElement(name="note")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/rest/
 * @Data
 */
class Rest extends MusicXMLWriter
{
	/**
	 * Measure
	 * -
	 * If yes, this indicates this is a complete measure rest.
	 *
	 * @Attribute(name="measure")
	 * @Value(type="yes-no" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $measure;

    /**
     * Display step
     *
     * @Element(name="display-step")
     * @var DisplayStep
     */
    public $displayStep;

    /**
     * Display octave
     *
     * @Element(name="display-octave")
     * @var DisplayOctave
     */
    public $displayOctave;
}