<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Bass
 * -
 * Bass is class of element &lt;bass&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;harmony&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="bass")
 * @ParentElement(name="harmony")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/bass/
 * @Data
 */
class Bass extends MusicXMLWriter
{
	/**
	 * Arrangement
	 * -
	 * Specifies where the bass is displayed relative to what precedes it.
	 *
	 * @Attribute(name="arrangement")
	 * @Value(type="harmony-arrangement" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $arrangement;

    /**
     * Bass separator
     *
     * @Element(name="bass-separator")
     * @var BassSeparator
     */
    public $bassSeparator;

    /**
     * Bass step
     *
     * @Element(name="bass-step")
     * @var BassStep
     */
    public $bassStep;

    /**
     * Bass alter
     *
     * @Element(name="bass-alter")
     * @var BassAlter
     */
    public $bassAlter;

}