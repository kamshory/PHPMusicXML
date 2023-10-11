<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PartLink
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/part-link/
 * @Data
 */
class PartLink extends MusicXMLWriter
{
	/**
	 * Xlink:href
	 *
	 * @Attribute(name="xlink:href")
	 * @var string
	 */
	public $xlinkHref;

	/**
	 * Xlink:actuate
	 *
	 * @Attribute(name="xlink:actuate")
	 * @var string
	 */
	public $xlinkActuate;

	/**
	 * Xlink:role
	 *
	 * @Attribute(name="xlink:role")
	 * @var string
	 */
	public $xlinkRole;

	/**
	 * Xlink:show
	 *
	 * @Attribute(name="xlink:show")
	 * @var string
	 */
	public $xlinkShow;

	/**
	 * Xlink:title
	 *
	 * @Attribute(name="xlink:title")
	 * @var string
	 */
	public $xlinkTitle;

	/**
	 * Xlink:type
	 *
	 * @Attribute(name="xlink:type")
	 * @var string
	 */
	public $xlinkType;
    
	/*
     * Instrument link
     *
     * @Element(name="instrument-link")
     * @var InstrumentLink[]
     */
    public $instrumentLink;

    /**
     * Group link
     *
     * @Element(name="group-link")
     * @var GroupLink[]
     */
    public $groupLink;

}