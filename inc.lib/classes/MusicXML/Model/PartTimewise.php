<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PartTimewise
 * -
 * PartTimewise is class of element &lt;part-timewise&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;measure&gt; (timewise)
 * 
 * @Xml
 * @MusicXML
 * @Element(name="part-timewise")
 * @ParentElement(name="measure (timewise)")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/part-timewise/
 * @Data
 */
class PartTimewise extends MusicXMLWriter
{
	/**
	 * Id
	 * -
	 * An IDREF back to a &lt;score-part&gt; element within the &lt;part-list&gt; element.
	 *
	 * @Attribute(name="id")
	 * @Value(type="IDREF" required="true", allowed="ANY_VALUE")
	 * @var string
	 */
	public $id;

    /**
     * Note list
     *
     * @Element
     * @var Note[]
     */
    public $note;

    /**
     * Backup
     *
     * @Element
     * @var Backup[]
     */
    public $backup;

    /**
     * Forward
     *
     * @Element
     * @var Forward[]
     */
    public $forward;

    /**
     * Direction
     *
     * @Element
     * @var Direction[]
     */
    public $direction;

    /**
     * Attribute list
     *
     * @Element(name="attributes")
     * @var Attributes[]
     */
    public $attributes;

    /**
     * Hamony
     *
     * @Element(name="hamony")
     * @var Hamony[]
     */
    public $hamony;

    /**
     * FiguredBass
     *
     * @Element(name="figuredBass")
     * @var FiguredBass[]
     */
    public $figuredBass;

    /**
     * XPrint
     *
     * @Element(name="print")
     * @var XPrint[]
     */
    public $print;

    /**
     * Sound
     *
     * @Element
     * @var Sound
     */
    public $sound;

    /**
     * Listening
     *
     * @Element
     * @var Listening[]
     */
    public $listening;

    /**
     * Baseline
     *
     * @Element
     * @var Baseline[]
     */
    public $baseline;

    /**
     * Grouping
     *
     * @Element(name="grouping")
     * @var Grouping[]
     */
    public $grouping;

    /**
     * Link
     *
     * @Element(name="link")
     * @var Link[]
     */
    public $link;

    /**
     * Bookmark
     *
     * @Element
     * @var Bookmark[]
     */
    public $bookmark;
}