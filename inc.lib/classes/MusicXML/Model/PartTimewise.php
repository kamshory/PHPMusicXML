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
     * Elements of part
     *
     * @Element(identification="element")
     * @var MusicXMLWriter[]
     */
    public $elements;
}