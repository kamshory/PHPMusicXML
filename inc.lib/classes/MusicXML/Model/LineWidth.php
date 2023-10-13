<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * LineWidth
 * -
 * LineWidth is class of element &lt;line-width&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;appearance&gt;
 * 
 * @Xml
 * @MusicXML
 * @ParentEelement="appearance")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/line-width/
 * @Data
 */
class LineWidth extends MusicXMLWriter
{
	/**
	 * Type
	 * -
	 * The type of line whose width is being defined.
	 *
	 * @Attribute(name="type")
	 * @Value(type="line-width-type" required="true", allowed="ANY_VALUE")
	 * @var string
	 */
	public $type;

	/**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;

}