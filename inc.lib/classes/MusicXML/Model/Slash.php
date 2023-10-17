<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Slash
 * -
 * Slash is class of element &lt;slash&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;measure-style&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="slash")
 * @ParentElement(name="measure-style")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/slash/
 * @Data
 */
class Slash extends MusicXMLWriter
{
	/**
	 * Type
	 * -
	 * Indicates the starting or stopping point of the section displaying slash notation.
	 *
	 * @Attribute(name="type")
	 * @Value(type="start-stop" required="true", allowed="start,stop")
	 * @var string
	 */
	public $type;

	/**
	 * Use dots
	 * -
	 * Indicates whether or not to use dots as well (for instance, with mixed rhythm patterns). The value is no if not specified. This attribute only has effect if use-stems is no.
	 *
	 * @Attribute(name="use-dots")
	 * @Value(type="yes-no" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $useDots;

	/**
	 * Use stems
	 * -
	 * If the slash is on every beat, use-stems is no (the default). To indicate rhythms but not pitches, use-stems is set to yes.
	 *
	 * @Attribute(name="use-stems")
	 * @Value(type="yes-no" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $useStems;

    /**
     * Use dot
     *
     * @Attribute
     * @var string
     */
    public $useDot;

    /**
     * Slash type
     *
     * @Element(name="slash-type")
     * @var SlashType
     */
    public $slashType;

    /**
     * Slash dot
     *
     * @Element
     * @var SlashDot[]
     */
    public $slashDot;

    /**
     * Excpet voice
     *
     * @Element
     * @var ExceptVoice[]
     */
    public $exceptVoice;
}