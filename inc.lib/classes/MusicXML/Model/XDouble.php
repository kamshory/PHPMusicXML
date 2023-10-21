<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * XDouble
 * -
 * XDouble is class of element &lt;double&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;part-transpose&gt;, &lt;transpose&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="double")
 * @ParentElement(name="part-transpose,transpose")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/double/
 * @Data
 */
class XDouble extends MusicXMLWriter
{
	/**
	 * Above
	 * -
	 * If the above attribute is set to yes, the doubling is one octave above what is written, as for mixed flute / piccolo parts in band literature. Otherwise the doubling is one octave below what is written, as for mixed cello / bass parts in orchestral literature.
	 *
	 * @Attribute(name="above")
	 * @Value(type="yes-no" required="false", allowed="yes,no")
	 * @var string
	 */
	public $above;

}