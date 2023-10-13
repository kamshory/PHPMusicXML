<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Cancel
 * -
 * Cancel is class of element &lt;cancel&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;key&gt;
 * 
 * @Xml
 * @MusicXML
 * @ParentEelement="key")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/cancel/
 * @Data
 */
class Cancel extends MusicXMLWriter
{
	/**
	 * Location
	 * -
	 * Indicates where the cancellation appears relative to the new key signature. It is left if not specified.
	 *
	 * @Attribute(name="location")
	 * @Value(type="cancel-location" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $location;

	/**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}