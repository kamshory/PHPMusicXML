<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * XPrint
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/print/
 * @Data
 */
class XPrint extends MusicXMLWriter
{
	/**
	 * Blank page
	 *
	 * @Attribute(name="blank-page")
	 * @var string
	 */
	public $blankPage;

	/**
	 * Id
	 *
	 * @Attribute(name="id")
	 * @var string
	 */
	public $id;

	/**
	 * New page
	 *
	 * @Attribute(name="new-page")
	 * @var string
	 */
	public $newPage;

	/**
	 * New system
	 *
	 * @Attribute(name="new-system")
	 * @var string
	 */
	public $newSystem;

	/**
	 * Page number
	 *
	 * @Attribute(name="page-number")
	 * @var string
	 */
	public $pageNumber;

	/**
	 * Staff spacing
	 *
	 * @Attribute(name="staff-spacing")
	 * @var string
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