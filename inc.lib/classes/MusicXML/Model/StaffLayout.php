<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * StaffLayout
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/staff-layout/
 * @Data
 */
class StaffLayout extends MusicXMLWriter
{
	/**
	 * Number
	 *
	 * @Attribute(name="number")
	 * @var string
	 */
	public $number;
    
	/**
     * Staff distance
     *
     * @Element(name="staff-distance")
     * @var StaffDistance
     */
    public $staffDistance;

}