<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PartLink
 * -
 * PartLink is class of element &lt;part-link&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;score-part&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="part-link")
 * @ParentElement(name="score-part")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/part-link/
 * @Data
 */
class PartLink extends MusicXMLWriter
{
	/**
	 * Xlink:href
	 * -
	 * The href attribute provides the data that allows an application to find a remote resource or resource fragment. See the 
	 *
	 * @Attribute(name="xlink:href")
	 * @Value(type="anyURI" required="true", allowed="ANY_VALUE")
	 * @var string
	 */
	public $xlinkHref;

	/**
	 * Xlink:actuate
	 * -
	 * The actuate attribute is used to communicate the desired timing of traversal from the starting resource to the ending resource. The default value is onRequest. See the 
	 *
	 * @Attribute(name="xlink:actuate")
	 * @Value(type="xlink:actuate" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $xlinkActuate;

	/**
	 * Xlink:role
	 * -
	 * The role attribute indicates a property of the link. See the 
	 *
	 * @Attribute(name="xlink:role")
	 * @Value(type="token" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $xlinkRole;

	/**
	 * Xlink:show
	 * -
	 * The show attribute is used to communicate the desired presentation of the ending resource on traversal from the starting resource. The default value is replace. See the 
	 *
	 * @Attribute(name="xlink:show")
	 * @Value(type="xlink:show" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $xlinkShow;

	/**
	 * Xlink:title
	 * -
	 * The title attribute describes the meaning of a link or resource in a human-readable fashion. See the 
	 *
	 * @Attribute(name="xlink:title")
	 * @Value(type="token" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $xlinkTitle;

	/**
	 * Xlink:type
	 * -
	 * The type attribute identifies XLink element types. In MusicXML, the value is always simple. See the 
	 *
	 * @Attribute(name="xlink:type")
	 * @Value(type="xlink:type" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $xlinkType;

	/**
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