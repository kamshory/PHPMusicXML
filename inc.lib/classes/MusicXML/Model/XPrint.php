<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * XPrint
 * -
 * XPrint is class of element &lt;print&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;measure&gt; (partwise), &lt;part&gt; (timewise)
 * 
 * @Xml
 * @MusicXML
 * @Element(name="print")
 * @ParentElement(name="measure (partwise),part (timewise)")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/print/
 * @Data
 */
class XPrint extends MusicXMLWriter
{
	/**
	 * Blank page
	 * -
	 * The number of blank pages to insert before the current measure. It is ignored if new-page is not &quot;yes&quot;. These blank pages have no music, but may have text or images specified by the credit element. This is used to allow a combination of pages that are all text, or all text and images, together with pages of music.
	 *
	 * @Attribute(name="blank-page")
	 * @Value(type="positiveInteger" required="false", min="0", max="infinite")
	 * @var integer
	 */
	public $blankPage;

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
	 * New page
	 * -
	 * Indicates whether to force a page break, or to force the current music onto the same page as the preceding music. Normally this is the first music data within a measure. If used in multi-part music, the attributes should be placed in the same positions within each part, or the results are undefined.
	 *
	 * @Attribute(name="new-page")
	 * @Value(type="yes-no" required="false", allowed="yes,no")
	 * @var string
	 */
	public $newPage;

	/**
	 * New system
	 * -
	 * Indicates whether to force a system break, or to force the current music onto the same system as the preceding music. Normally this is the first music data within a measure. If used in multi-part music, the attributes should be placed in the same positions within each part, or the results are undefined.
	 *
	 * @Attribute(name="new-system")
	 * @Value(type="yes-no" required="false", allowed="yes,no")
	 * @var string
	 */
	public $newSystem;

	/**
	 * Page number
	 * -
	 * Sets the number of a new page. It is ignored if new-page is not &quot;yes&quot;.
	 *
	 * @Attribute(name="page-number")
	 * @Value(type="token" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $pageNumber;

	/**
	 * Staff spacing
	 * -
	 * Specifies spacing between multiple staves in tenths of staff space. Deprecated as of Version 1.1; the staff-layout element should be used instead. If both are present, the staff-layout values take priority.
	 *
	 * @Attribute(name="staff-spacing")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $staffSpacing;

	/**
     * Page layout
     *
     * @Element(name="page-layout")
     * @var PageLayout
     */
    public $pageLayout;

    /**
     * System layout
     *
     * @Element(name="system-layout")
     * @var SystemLayout
     */
    public $systemLayout;

    /**
     * Staff layout
     *
     * @Element(name="staff-layout")
     * @var StaffLayout[]
     */
    public $staffLayout;

    /**
     * Measure layout
     *
     * @Element(name="measure-layout")
     * @var MeasureLayout
     */
    public $measureLayout;

    /**
     * Measure numbering
     *
     * @Element(name="measure-numbering")
     * @var MeasureNumbering
     */
    public $measureNumbering;

    /**
     * Part name display
     *
     * @Element(name="part-name-display")
     * @var PartNameDisplay
     */
    public $partNameDisplay;

    /**
     * Part abbreviation display
     *
     * @Element(name="part-abbreviation-display")
     * @var PartAbbreviationDisplay
     */
    public $partAbbreviationDisplay;
}