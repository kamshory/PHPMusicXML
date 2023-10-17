<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Creator
 * -
 * Creator is class of element &lt;creator&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;identification&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="creator")
 * @ParentElement(name="identification")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/creator/
 * @Data
 */
class Creator extends MusicXMLWriter
{
	/**
	 * Type
	 * -
	 * Distinguishes different creative contributions. Thus there can be multiple &lt;creator&gt; elements within an &lt;identification&gt; element. Standard values are composer, lyricist, and arranger. Other values may be used for different types of creative roles. This attribute should usually be used even if there is just a single &lt;creator&gt; element.
	 *
	 * @Attribute(name="type")
	 * @Value(type="token" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $type;

	/**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}