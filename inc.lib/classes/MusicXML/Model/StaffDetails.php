<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * StaffDetails
 * -
 * StaffDetails is class of element &lt;staff-details&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;attributes&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="staff-details")
 * @ParentElement(name="attributes")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/staff-details/
 * @Data
 */
class StaffDetails extends MusicXMLWriter
{
	/**
	 * Number
	 * -
	 * Specifies the staff number from top to bottom within the part. The value is 1 if not present.
	 *
	 * @Attribute(name="number")
	 * @Value(type="staff-number" required="false", min="1", max="infinite")
	 * @var integer
	 */
	public $number;

	/**
	 * Print object
	 * -
	 * Specifies whether or not to print an object. It is yes if not specified.
	 *
	 * @Attribute(name="print-object")
	 * @Value(type="yes-no" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $printObject;

	/**
	 * Print spacing
	 * -
	 * Controls whether or not spacing is left for an invisible note or object. It is used only if no note, dot, or lyric is being printed. The value is yes (leave spacing) if not specified.
	 *
	 * @Attribute(name="print-spacing")
	 * @Value(type="yes-no" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $printSpacing;

	/**
	 * Show frets
	 * -
	 * Indicates whether to show tablature frets as numbers (0, 1, 2) or letters (a, b, c). It is numbers if not specified.
	 *
	 * @Attribute(name="show-frets")
	 * @Value(type="show-frets" required="false", allowed="letters,numbers")
	 * @var string
	 */
	public $showFrets;

    /**
     * Staff type
     *
     * @Element(name="staff-type")
     * @var StaffType
     */
    public $staffType;

    /**
     * Staff lines
     *
     * @Element(name="staff-lines")
     * @var StaffLines
     */
    public $staffLines;

    /**
     * Line detail
     *
     * @Element(name="line-detail")
     * @var LineDetail[]
     */
    public $lineDetail;

    /**
     * Staff tuning
     *
     * @Element(name="staff-tuning")
     * @var StaffTuning[]
     */
    public $staffTuning;

    /**
     * Capo
     *
     * @Element(name="capo")
     * @var Capo
     */
    public $capo;

    /**
     * Staff size
     *
     * @Element(name="staff-size")
     * @var StaffSize
     */
    public $staffSize;

}