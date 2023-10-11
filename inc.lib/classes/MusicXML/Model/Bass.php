<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Bass
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/bass/
 * @Data
 */
class Bass extends MusicXMLWriter
{
	/**
	 * Arrangement
	 *
	 * @Attribute(name="arrangement")
	 * @var string
	 */
	public $arrangement;
    
    /*
     * Bass separator
     *
     * @Element(name="bass-separator")
     * @var BassSeparator
     */
    public $bassSeparator;

    /*
     * Bass step
     *
     * @Element(name="bass-step")
     * @var BassStep
     */
    public $bassStep;

    /*
     * Bass alter
     *
     * @Element(name="bass-alter")
     * @var BassAlter
     */
    public $bassAlter;

}