<?php

namespace MusicXML;

use DOMDocument;
use DOMImplementation;

class MusicXMLBase
{
    const XML_VERSION = "1.0";
    const XML_ENCODING = "UTF-8";
    const DOCUMENT_ID = "score-partwise";
    const PUBLIC_ID = "-//Recordare//DTD MusicXML 4.0 Partwise//EN";
    const SYSTEM_ID = "http://www.musicxml.org/dtds/partwise.dtd";

    /**
     * Create new DOMDocument
     *
     * @return DOMDocument
     */
    public function getDOMDocument()
    {
        $domdoc = new DOMDocument();
        $domdoc->xmlVersion = self::XML_VERSION;
        $domdoc->encoding = self::XML_ENCODING;
        $implementation = new DOMImplementation();
        $domdoc->appendChild($implementation->createDocumentType(self::DOCUMENT_ID, self::PUBLIC_ID, self::SYSTEM_ID));
        $domdoc->preserveWhiteSpace = false;
        $domdoc->formatOutput = true;
        return $domdoc;
    }

    /**
     * Get instrument  name
     *
     * @param integer $instrumentId
     * @param integer $channelId
     * @return array
     */
    public function getInstrumentName($instrumentId, $channelId)
    {
        if($channelId == 10)
        {
            $id = $instrumentId + 1;
            return array('Instrument '.$id, 'Instrument '.$id);
        }
        else
        {
            return $this->instrumentList[$instrumentId];
        }
    }

    protected $instrumentList = array(
        0=>array('Piano', 'Pno.'),
        1=>array('Bright Piano', 'B. Pno.'),
        2=>array('Electric Grand', 'E. G. Pno.'),
        3=>array('Honky Tonk Piano', 'H. T. Pno'),
        4=>array('Electric Piano 1', 'E. Pno1.'),
        5=>array('Electric Piano 2', 'E. Pno2.'),
        6=>array('Harpsichord', 'Haspchord'),
        7=>array('Clavinet', ''),
        8=>array('Celesta', ''),
        9=>array('Glockenspiel', ''),
        10=>array('Music Box', ''),
        11=>array('Vibraphone', ''),
        12=>array('Marimba', ''),
        13=>array('Xylophone', ''),
        14=>array('Tubular Bell', ''),
        15=>array('Dulcimer', ''),
        16=>array('Hammond Organ', ''),
        17=>array('Perc Organ', ''),
        18=>array('Rock Organ', ''),
        19=>array('Church Organ', ''),
        20=>array('Reed Organ', ''),
        21=>array('Accordion', ''),
        22=>array('Harmonica', ''),
        23=>array('Tango Accordion', ''),
        24=>array('Nylon Str Guitar', ''),
        25=>array('Steel String Guitar', ''),
        26=>array('Jazz Electric Gtr', ''),
        27=>array('Clean Guitar', ''),
        28=>array('Muted Guitar', ''),
        29=>array('Overdrive Guitar', ''),
        30=>array('Distortion Guitar', ''),
        31=>array('Guitar Harmonics', ''),
        32=>array('Acoustic Bass', ''),
        33=>array('Fingered Bass', ''),
        34=>array('Picked Bass', ''),
        35=>array('Fretless Bass', ''),
        36=>array('Slap Bass 1', ''),
        37=>array('Slap Bass 2', ''),
        38=>array('Syn Bass 1', ''),
        39=>array('Syn Bass 2', ''),
        40=>array('Violin', ''),
        41=>array('Viola', ''),
        42=>array('Cello', ''),
        43=>array('Contrabass', ''),
        44=>array('Tremolo Strings', ''),
        45=>array('Pizzicato Strings', ''),
        46=>array('Orchestral Harp', ''),
        47=>array('Timpani', ''),
        48=>array('Ensemble Strings', ''),
        49=>array('Slow Strings', ''),
        50=>array('Synth Strings 1', ''),
        51=>array('Synth Strings 2', ''),
        52=>array('Choir Aahs', ''),
        53=>array('Voice Oohs', ''),
        54=>array('Syn Choir', ''),
        55=>array('Orchestra Hit', ''),
        56=>array('Trumpet', ''),
        57=>array('Trombone', ''),
        58=>array('Tuba', ''),
        59=>array('Muted Trumpet', ''),
        60=>array('French Horn', ''),
        61=>array('Brass Ensemble', ''),
        62=>array('Syn Brass 1', ''),
        63=>array('Syn Brass 2', ''),
        64=>array('Soprano Sax', ''),
        65=>array('Alto Sax', ''),
        66=>array('Tenor Sax', ''),
        67=>array('Baritone Sax', ''),
        68=>array('Oboe', ''),
        69=>array('English Horn', ''),
        70=>array('Bassoon', ''), 
        71=>array('Clarinet', ''), 
        72=>array('Piccolo', ''), 
        73=>array('Flute', ''), 
        74=>array('Recorder', ''),
        75=>array('Pan Flute', ''), 
        76=>array('Bottle Blow', ''), 
        77=>array('Shakuhachi', ''), 
        78=>array('Whistle', ''),
        79=>array('Ocarina', ''), 
        80=>array('Syn Square Wave', ''), 
        81=>array('Syn Saw Wave', ''), 
        82=>array('Syn Calliope', ''),
        83=>array('Syn Chiff', ''), 
        84=>array('Syn Charang', ''), 
        85=>array('Syn Voice', ''), 
        86=>array('Syn Fifths Saw', ''),
        87=>array('Syn Brass and Lead', ''), 
        88=>array('Fantasia', ''), 
        89=>array('Warm Pad', ''), 
        90=>array('Polysynth', ''),
        91=>array('Space Vox', ''), 
        92=>array('Bowed Glass', ''), 
        93=>array('Metal Pad', ''), 
        94=>array('Halo Pad', ''),
        95=>array('Sweep Pad', ''), 
        96=>array('Ice Rain', ''), 
        97=>array('Soundtrack', ''), 
        98=>array('Crystal', ''),
        99=>array('Atmosphere', ''), 
        100=>array('Brightness', ''), 
        101=>array('Goblins', ''),
        102=>array('Echo Drops', ''), 
        103=>array('Sci Fi', ''), 
        104=>array('Sitar', ''),
        105=>array('Banjo', ''), 
        106=>array('Shamisen', ''), 
        107=>array('Koto', ''),
        108=>array('Kalimba', ''), 
        109=>array('Bag Pipe', ''), 
        110=>array('Fiddle', ''), 
        111=>array('Shanai', ''), 
        112=>array('Tinkle Bell', ''),
        113=>array('Agogo', ''), 
        114=>array('Steel Drums', ''), 
        115=>array('Woodblock', ''), 
        116=>array('Taiko Drum', ''),
        117=>array('Melodic Tom', ''), 
        118=>array('Syn Drum', ''), 
        119=>array('Reverse Cymbal', ''),
        120=>array('Guitar Fret Noise', ''), 
        121=>array('Breath Noise', ''), 
        122=>array('Seashore', ''), 
        123=>array('Bird', ''), 
        124=>array('Telephone', ''), 
        125=>array('Helicopter', ''), 
        126=>array('Applause', ''), 
        127=>array('Gunshot', '')
    );

    protected $drumSet = array(
        35 => array('Acoustic Bass Drum', ''),
        36 => array('Bass Drum 1', ''),
        37 => array('Side Stick', ''),
        38 => array('Acoustic Snare', ''),
        39 => array('Hand Clap', ''),
        40 => array('Electric Snare', ''),
        41 => array('Low Floor Tom', ''),
        42 => array('Closed Hi-Hat', ''),
        43 => array('High Floor Tom', ''),
        44 => array('Pedal Hi-Hat', ''),
        45 => array('Low Tom', ''),
        46 => array('Open Hi-Hat', ''),
        47 => array('Low Mid Tom', ''),
        48 => array('High Mid Tom', ''),
        49 => array('Crash Cymbal 1', ''),
        50 => array('High Tom', ''),
        51 => array('Ride Cymbal 1', ''),
        52 => array('Chinese Cymbal', ''),
        53 => array('Ride Bell', ''),
        54 => array('Tambourine', ''),
        55 => array('Splash Cymbal', ''),
        56 => array('Cowbell', ''),
        57 => array('Crash Cymbal 2', ''),
        58 => array('Vibraslap', ''),
        59 => array('Ride Cymbal 2', ''),
        60 => array('High Bongo', ''),
        61 => array('Low Bongo', ''),
        62 => array('Mute High Conga', ''),
        63 => array('Open High Conga', ''),
        64 => array('Low Conga', ''),
        65 => array('High Timbale', ''),
        66 => array('Low Timbale', ''),
        //35..66
        67 => array('High Agogo', ''),
        68 => array('Low Agogo', ''),
        69 => array('Cabase', ''),
        70 => array('Maracas', ''),
        71 => array('Short Whistle', ''),
        72 => array('Long Whistle', ''),
        73 => array('Short Guiro', ''),
        74 => array('Long Guiro', ''),
        75 => array('Claves', ''),
        76 => array('High Wood Block', ''),
        77 => array('Low Wood Block', ''),
        78 => array('Mute Cuica', ''),
        79 => array('Open Cuica', ''),
        80 => array('Mute Triangle', ''),
        81 => array('Open Triangle', '')
    );

    protected $drumkitList = array(
        1   => array('Dry', ''),
        9   => array('Room', ''),
        19  => array('Power', ''),
        25  => array('Electronic', ''),
        33  => array('Jazz', ''),
        41  => array('Brush', ''),
        57  => array('SFX', ''),
        128 => array('Default', '')
    );
}
