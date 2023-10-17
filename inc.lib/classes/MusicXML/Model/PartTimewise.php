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
     * -
     * This element tag will exactly match the element name. See annotations of class of each elements. Element of part-timewise consists of:
     * - &lt;note&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/note/
     * - &lt;backup&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/backup/
     * - &lt;forward&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/forward/
     * - &lt;direction&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/direction/
     * - &lt;attributes&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/attributes/
     * - &lt;harmony&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/harmony/
     * - &lt;figured-bass&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/figured-bass/
     * - &lt;print&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/print/
     * - &lt;sound&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/sound/
     * - &lt;listening&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/listening/
     * - &lt;barline&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/barline/
     * - &lt;grouping&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/grouping/
     * - &lt;link&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/link/
     * - &lt;bookmark&gt; - See https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/bookmark/
     *
     * @Element(identification="element")
     * @var MusicXMLWriter[]
     */
    public $elements;
}
