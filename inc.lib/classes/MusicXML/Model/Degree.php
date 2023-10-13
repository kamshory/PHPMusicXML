<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Degree
 * -
 * Degree is class of element &lt;degree&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;harmony&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="degree")
 * @ParentElement(name="harmony")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/degree/
 * @Data
 */
class Degree extends MusicXMLWriter
{
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