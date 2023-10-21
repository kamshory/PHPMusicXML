<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Grace
 * -
 * Grace is class of element &lt;grace&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;note&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="grace")
 * @ParentElement(name="note")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/grace/
 * @Data
 */
class Grace extends MusicXMLWriter
{
	/**
	 * Make time
	 * -
	 * Indicates to make time, not steal time, for grace note playback. The units are in real-time divisions for the grace note.
	 *
	 * @Attribute(name="make-time")
	 * @Value(type="divisions" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $makeTime;

	/**
	 * Slash
	 * -
	 * The value is yes for slashed grace notes and no if no slash is present.
	 *
	 * @Attribute(name="slash")
	 * @Value(type="yes-no" required="false", allowed="yes,no")
	 * @var string
	 */
	public $slash;

	/**
	 * Steal time following
	 * -
	 * Indicates the percentage of time to steal from the following note for the grace note playback, as for appoggiaturas.
	 *
	 * @Attribute(name="steal-time-following")
	 * @Value(type="percent" required="false", min="0", max="100")
	 * @var float
	 */
	public $stealTimeFollowing;

	/**
	 * Steal time previous
	 * -
	 * The steal-time-previous attribute indicates the percentage of time to steal from the previous note for the grace note playback.
	 *
	 * @Attribute(name="steal-time-previous")
	 * @Value(type="percent" required="false", min="0", max="100")
	 * @var float
	 */
	public $stealTimePrevious;

    /**
     * Make time
     *
     * @Attribute(name="make-time")
     * @var string
     */
    public $nameTime;

}