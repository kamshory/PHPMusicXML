<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PartPartwise
 * -
 * PartPartwise is class of element &lt;part-partwise&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;score-partwise&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="part-partwise")
 * @ParentElement(name="score-partwise")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/part-partwise/
 * @Data
 */
class PartPartwise extends MusicXMLWriter
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
     * MeasurePartwise list
     *
     * @Element(name="measure")
     * @var MeasurePartwise[]
     */
    public $measure;
}