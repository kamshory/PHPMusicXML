<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PedalTuning
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/pedal-tuning/
 * @Data
 */
class PedalTuning extends MusicXMLWriter
{
    /**
     * Pedal step
     *
     * @PropertyElement(name="pedal-step")
     * @var string
     */
    public $pedalStep;
    
    /**
     * Pedal tuning
     *
     * @PropertyElement(name="pedal-alter")
     * @var float
     */
    public $pedalAlter;
}