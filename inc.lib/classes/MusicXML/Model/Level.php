<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Level
 * -
 * Level is class of element &lt;level&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;attributes&gt;, &lt;backup&gt;, &lt;barline&gt;, &lt;direction&gt;, &lt;figure&gt;, &lt;figured-bass&gt;, &lt;forward&gt;, &lt;harmony&gt;, &lt;lyric&gt;, &lt;notations&gt;, &lt;note&gt;, &lt;part-group&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="level")
 * @ParentElement(name="attributes,backup,barline,direction,figure,figured-bass,forward,harmony,lyric,notations,note,part-group")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/level/
 * @Data
 */
class Level extends MusicXMLWriter
{
	/**
	 * Bracket
	 * -
	 * Specifies whether or not brackets are put around a symbol for an editorial indication. If not specified, it is left to application defaults.
	 *
	 * @Attribute(name="bracket")
	 * @Value(type="yes-no" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $bracket;

	/**
	 * Parentheses
	 * -
	 * Specifies whether or not parentheses are put around a symbol for an editorial indication. If not specified, it is left to application defaults.
	 *
	 * @Attribute(name="parentheses")
	 * @Value(type="yes-no" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $parentheses;

	/**
	 * Reference
	 * -
	 * If the reference attribute is yes, this indicates editorial information that is for display only and should not affect playback. For instance, a modern edition of older music may set reference=&quot;yes&quot; on the attributes containing the music's original clef, key, and time signature. It is no if not specified.
	 *
	 * @Attribute(name="reference")
	 * @Value(type="yes-no" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $reference;

	/**
	 * Size
	 * -
	 * Specifies the symbol size to use for an editorial indication. If not specified, it is left to application defaults.
	 *
	 * @Attribute(name="size")
	 * @Value(type="symbol-size" required="false", allowed="cue,full,grace-cue,large")
	 * @var string
	 */
	public $size;

	/**
	 * Type
	 * -
	 * Indicates whether the editorial information applies to the start of a series of symbols, the end of a series of symbols, or a single symbol. It is single if not specified for compatibility with earlier MusicXML versions.
	 *
	 * @Attribute(name="type")
	 * @Value(type="start-stop-single" required="false", allowed="start,stop,single")
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