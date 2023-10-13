<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PedalTuning
 * -
 * PedalTuning is class of element &lt;pedal-tuning&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;harp-pedals&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="pedal-tuning")
 * @ParentElement(name="harp-pedals")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/pedal-tuning/
 * @Data
 */
class PedalTuning extends MusicXMLWriter
{

    /**
     * Pedal step
     *
     * @Element(name="pedal-step")
     * @var PedalStep
     */
    public $pedalStep;

    /**
     * Pedal tuning
     *
     * @Element(name="pedal-alter")
     * @var PedalAlter
     */
    public $pedalAlter;
}