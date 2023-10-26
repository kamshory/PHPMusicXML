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
 * @Element(name="line-width")
 * @ParentElement(name="appearance")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/line-width/
 * @Update(date-time="2023-10-26 11:23:50")
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
	 * @Value(type="line-width-type" required="true", allowed="beam,bracket,dashes,enclosure,ending,extend,heavy barline,leger,light barline,octave shift,pedal,slur middle,slur tip,staff,stem,tie middle,tie tip,tuplet bracket,wedge")
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