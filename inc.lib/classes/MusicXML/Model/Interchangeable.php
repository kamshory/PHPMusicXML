<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Interchangeable
 * -
 * Interchangeable is class of element &lt;interchangeable&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;time&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="interchangeable")
 * @ParentElement(name="time")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/interchangeable/
 * @Data
 */
class Interchangeable extends MusicXMLWriter
{
	/**
	 * Separator
	 * -
	 * Indicates how to display the arrangement between the &lt;beats&gt; and &lt;beat-type&gt; values in the second of the dual time signatures.
	 *
	 * @Attribute(name="separator")
	 * @Value(type="time-separator" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $separator;

	/**
	 * Symbol
	 * -
	 * Indicates how to display the second of the dual time signatures, such as by using common and cut time symbols or a single number display.
	 *
	 * @Attribute(name="symbol")
	 * @Value(type="time-symbol" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $symbol;

	/**
     * Time relation
     *
     * @Element(name="time-relation")
     * @var TimeRelation
     */
    public $timeRelation;

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
     * @Element(name="beat-type")
     * @var BeatType[]
     */
    public $beatType;
}