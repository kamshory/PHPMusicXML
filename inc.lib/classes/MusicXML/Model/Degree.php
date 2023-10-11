<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Degree
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/degree/
 * @Data
 */
class Degree extends MusicXMLWriter
{
	/**
	 * Print object
	 *
	 * @Attribute(name="print-object")
	 * @var string
	 */
	public $printObject;
    
    /**
     * Degree value
     *
     * @Element(name="degree-value")
     * @var DegreeValue
     */
    public $degreeValue;

    /**
     * Degree alter
     *
     * @Element(name="degree-alter")
     * @var DegreeAlter
     */
    public $degreeAlter;

    /**
     * Degree type
     *
     * @Element(name="degree-type")
     * @var DegreeType
     */
    public $degreeType;

}