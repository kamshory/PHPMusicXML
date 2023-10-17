<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Barline
 * -
 * Barline is class of element &lt;barline&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;measure&gt; (partwise), &lt;part&gt; (timewise)
 * 
 * @Xml
 * @MusicXML
 * @Element(name="barline")
 * @ParentElement(name="measure (partwise),part (timewise)")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/barline/
 * @Data
 */
class Barline extends MusicXMLWriter
{
	/**
	 * Coda
	 * -
	 * Used for playback when there is a &lt;coda&gt; child element. Indicates the end point for a forward jump to a coda sign. If there are multiple jumps, the value of these parameters can be used to name and distinguish them.
	 *
	 * @Attribute(name="coda")
	 * @Value(type="token" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $coda;

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
	 * Location
	 * -
	 * Barlines have a location attribute to make it easier to process barlines independently of the other musical data in a score. It is often easier to set up measures separately from entering notes. The location attribute must match where the &lt;barline&gt; element occurs within the rest of the musical data in the score. If location is left, it should be the first element in the measure, aside from the &lt;print&gt;, &lt;bookmark&gt;, and &lt;link&gt; elements. If location is right, it should be the last element, again with the possible exception of the &lt;print&gt;, &lt;bookmark&gt;, and &lt;link&gt; elements. The default value is right.
	 *
	 * @Attribute(name="location")
	 * @Value(type="right-left-middle" required="false", allowed="right,left,middle")
	 * @var string
	 */
	public $location;

	/**
	 * Segno
	 * -
	 * Used for playback when there is a &lt;segno&gt; child element. Indicates the end point for a backward jump to a segno sign. If there are multiple jumps, the value of these parameters can be used to name and distinguish them.
	 *
	 * @Attribute(name="segno")
	 * @Value(type="token" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $segno;

	/**
     * Bar style
     *
     * @Element(name="bar-style")
     * @var BarStyle
     */
    public $barStyle;

    /**
     * Footnote
     *
     * @Element(name="footnote")
     * @var Footnote
     */
    public $footnote;

    /**
     * Level
     *
     * @Element(name="level")
     * @var Level
     */
    public $level;

    /**
     * Wavy line
     *
     * @Element(name="wavy-line")
     * @var WavyLine
     */
    public $wavyLine;

    /**
     * Fermata
     *
     * @Element(name="fermata")
     * @var Fermata[]
     */
    public $fermata;

    /**
     * Ending
     *
     * @Element(name="ending")
     * @var Ending
     */
    public $ending;

    /**
     * Repeat
     *
     * @Element(name="repeat")
     * @var Repeat
     */
    public $repeat;

}