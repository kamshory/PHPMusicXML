<?php

namespace MusicXML;

use DateTime;
use DOMDocument;
use DOMImplementation;
use Exceptions\FileNotFoundException;
use Midi\MidiMeasure;
use MusicXML\Model\Alter;
use MusicXML\Model\Articulations;
use MusicXML\Model\Beats;
use MusicXML\Model\BeatType;
use MusicXML\Model\Encoder;
use MusicXML\Model\Encoding;
use MusicXML\Model\EncodingDate;
use MusicXML\Model\EncodingDescription;
use MusicXML\Model\Identification;
use MusicXML\Model\InstrumentName;
use MusicXML\Model\InstrumentSound;
use MusicXML\Model\Key;
use MusicXML\Model\MidiChannel;
use MusicXML\Model\MidiDevice;
use MusicXML\Model\MidiInstrument;
use MusicXML\Model\MidiProgram;
use MusicXML\Model\Notations;
use MusicXML\Model\Pan;
use MusicXML\Model\PartAbbreviation;
use MusicXML\Model\PartName;
use MusicXML\Model\Pitch;
use MusicXML\Model\Rights;
use MusicXML\Model\ScoreInstrument;
use MusicXML\Model\ScorePart;
use MusicXML\Model\Software;
use MusicXML\Model\Staccato;
use MusicXML\Model\Step;
use MusicXML\Model\Supports;
use MusicXML\Model\Time;
use MusicXML\Model\Volume;
use MusicXML\Properties\TimeSignature;

class MusicXMLBase
{
    const XML_VERSION = "1.0";
    const XML_ENCODING = "UTF-8";
    const DOCUMENT_ID = "score-partwise";
    const PUBLIC_ID = "-//Recordare//DTD MusicXML 4.0 Partwise//EN";
    const SYSTEM_ID = "http://www.musicxml.org/dtds/partwise.dtd";
    const SCORE_PARTWISE = "score-partwise";
    const SOFTWARE_NAME = "Planetbiru";
    const ENCODING_DESCRIPTION = "This software is not ready for production yet";

    public function fixDuration($duration)
    {
        return $duration / 4;
    }

    public function loadMidi($midiPath)
    {
        if(file_exists($midiPath))
        {
            $midi = new MidiMeasure();
            $midi->importMid($midiPath);
            return $midi;
        }
        else
        {
            throw new FileNotFoundException("Specified file does not exists");
        }
    }

    public function calculateDuration($duration0, $divisions, $timebase)
    {
        $duration = $divisions * $duration0 * $timebase / 4;
        if($duration > $divisions * 16)
        {
            $duration = $divisions * 16;
        }
        return $duration;
    }
    
    /**
     * Get notation
     *
     * @return Notations
     */
    public function getNotation()
    {
        $notations = new Notations();
        $articulation = new Articulations();
        $articulation->staccato = array(new Staccato());
        $notations->articulations = $articulation;
        
        return $notations;
    }

    /**
     * Dget note type
     *
     * @param integer $duration
     * @param integer $divisions
     * @return string
     */
    public function getNoteType($duration, $divisions)
    {
        $value = $duration/(4*$divisions);
        foreach($this->type as $type=>$valueType)
        {
            if($value >= $valueType)
            {
                return $type;
            }
        }
        return 'whole';
    }
    protected $type = array(
        'maxima'=>5,
        'long'=>4,
        'breve'=>2,
        'whole'=>1,
        'half'=>1/2,
        'quarter'=>1/4,
        'eighth'=>1/8,
        '16th'=>1/16,
        '32nd'=>1/32,
        '64th'=>1/64,
        '128th'=>1/128,
        '256th'=>1/256,
        '512th'=>1/512,
        '1024th'=>1/1024
    );
    
    /**
     * Initialize array
     *
     * @param array|null
     * @return array
     */
    public function initializeArray($initialValue)
    {
        if(!isset($initialValue))
        {
            return array();
        }
        return $initialValue;
    }
    
    /**
     * Get time
     *
     * @param TimeSignature $timeSignature
     * @return Time
     */
    public function getTime($timeSignature)
    {
        $time = new Time();
        $time->beats = array(new Beats($timeSignature->getBeats()));
        $time->beatType = array(new BeatType($timeSignature->getBeatType()));
        return $time;
    }
    
    /**
     * Get key
     *
     * @param integer $fifths
     * @param integer $mode
     * @return Key
     */
    public function getKey($fifths, $mode)
    {
        $key = new Key();
        $key->fifths = $fifths;
        $key->mode = $mode;
        return $key;
    }


    protected $noteList = array(
        //Do          Re           Mi    Fa           So           La           Ti
        'C-1', 'Cs-1', 'D-1', 'Ds-1', 'E-1', 'F-1', 'Fs-1', 'G-1', 'Gs-1', 'A-1', 'As-1', 'B-1',
        'C0', 'Cs0', 'D0', 'Ds0', 'E0', 'F0', 'Fs0', 'G0', 'Gs0', 'A0', 'As0', 'B0',
        'C1', 'Cs1', 'D1', 'Ds1', 'E1', 'F1', 'Fs1', 'G1', 'Gs1', 'A1', 'As1', 'B1',
        'C2', 'Cs2', 'D2', 'Ds2', 'E2', 'F2', 'Fs2', 'G2', 'Gs2', 'A2', 'As2', 'B2',
        'C3', 'Cs3', 'D3', 'Ds3', 'E3', 'F3', 'Fs3', 'G3', 'Gs3', 'A3', 'As3', 'B3',
        'C4', 'Cs4', 'D4', 'Ds4', 'E4', 'F4', 'Fs4', 'G4', 'Gs4', 'A4', 'As4', 'B4',
        'C5', 'Cs5', 'D5', 'Ds5', 'E5', 'F5', 'Fs5', 'G5', 'Gs5', 'A5', 'As5', 'B5',
        'C6', 'Cs6', 'D6', 'Ds6', 'E6', 'F6', 'Fs6', 'G6', 'Gs6', 'A6', 'As6', 'B6',
        'C7', 'Cs7', 'D7', 'Ds7', 'E7', 'F7', 'Fs7', 'G7', 'Gs7', 'A7', 'As7', 'B7',
        'C8', 'Cs8', 'D8', 'Ds8', 'E8', 'F8', 'Fs8', 'G8', 'Gs8', 'A8', 'As8', 'B8',
        'C9', 'Cs9', 'D9', 'Ds9', 'E9', 'F9', 'Fs9', 'G9', 'Gs9', 'A9', 'As9', 'B9',
        'C10','Cs10','D10','Ds10','E10','F10','Fs10','G10');


    /**
     * Get MIDI device
     *
     * @param integer $midiId
     * @param integer $port
     * @return MidiDevice
     */
    protected function getMidiDevice($midiId, $port)
    {
        $midiDevice = new MidiDevice();
        $midiDevice->id = $midiId;
        $midiDevice->port = $port;
        return $midiDevice;
    }

    /**
     * Get score instrument
     *
     * @return ScoreInstrument
     */
    protected function getScoreInstrument($instrumentId, $instrumentName, $instrumentSound)
    {
        $scoreInstrument = new ScoreInstrument();
        $scoreInstrument->id = $instrumentId;
        $scoreInstrument->instrumentName = new InstrumentName($instrumentName);
        $scoreInstrument->instrumentSound = new InstrumentSound($instrumentSound);
        return $scoreInstrument;
    }

    /**
     * Get score instrument
     *
     * @return MidiInstrument
     */
    protected function getMidiInstrument($midiChannel, $instrumentId, $midiProgramId, $volume = 100, $pan = 0)
    {
        $midiInstrument = new MidiInstrument();
        $midiInstrument->id = $instrumentId;
        $midiInstrument->midiChannel = new MidiChannel($midiChannel);
        $midiInstrument->midiProgram = new MidiProgram($midiProgramId);
        $midiInstrument->volume = new Volume($volume);
        $midiInstrument->pan = new Pan($pan);
        return $midiInstrument;
    }

    /**
     * Get score part
     *
     * @param string $partId
     * @param string $partName
     * @param string $partAbbreviation
     * @param ScoreInstrument $scoreInstrument
     * @param MidiInstrument $midiInstrument
     * @param MidiDevice $midiDevice
     * @return ScorePart
     */
    public function getScorePart($partId, $partName, $partAbbreviation, $scoreInstrument, $midiInstrument, $midiDevice)
    {
        $scorePart = new ScorePart();
        $scorePart->id = $partId;
        $scorePart->partName = new PartName($partName);
        $scorePart->partAbbreviation = new PartAbbreviation($partAbbreviation);
        $scorePart->scoreInstrument = array($scoreInstrument);
        $scorePart->midiInstrument = array($midiInstrument);
        $scorePart->midiDevice = array($midiDevice);
        return $scorePart;
    }
    /**
     * Create new DOMDocument for MusicXML version 4.0
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
        if ($channelId == 10) {
            $id = $instrumentId + 1;
            if(isset($this->drumSet[$instrumentId]))
            {
                return $this->drumSet[$instrumentId];
            }
            else
            {
                return array('Instrument ' . $id, 'Instrument ' . $id);
            }
            
        } else {
            return $this->instrumentList[$instrumentId];
        }
    }

    /**
     * Get picth from note
     *
     * @param integer $note
     * @return Pitch
     */
    protected function getPitch($note)
    {
        $pitchStr = $this->noteList[$note];
        $pitch = new Pitch();
        $step = new Step();
        $step->textContent = preg_replace("/[^A-G]/", "", $pitchStr);
        $pitch->step = $step;
        
        $octaveStr = (preg_replace("/[^\-\d]/", "", $pitchStr));
        if(empty($octaveStr))
        {
            $octaveStr = "0";
        }
        $pitch->octave = intval($octaveStr);
        if (strpos($pitchStr, 's') !== false) {
            $alter = new Alter();
            $alter->textContent = 1;
            $pitch->alter = $alter;
        }
        if($pitch->step == 'B' && $pitch->octave == -1)
        {
            echo "NOTE = $note; PITH = ".$pitch."\r\n";
        }
        return $pitch;
    }

    /**
     * Get programs
     *
     * @param array $midiEventMessages
     * @return array
     */
    protected function getControlEvent($midiEventMessages)
    {
        $messages = array();
        foreach ($midiEventMessages as $message) {
            if ($message['event'] != 'On' && $message['event'] != 'Off') {
                $messages[] = $message;
            }
        }
        return $messages;
    }
    
    /**
     * Get minimum duration
     *
     * @param array $midiEventMessages
     * @param integer $timebase
     * @return float
     */
    protected function getMinimumDuration($midiEventMessages, $timebase)
    {
        $min = $timebase;
        foreach ($midiEventMessages as $message) {
            if (isset($message['duration']) && $message['duration'] > 0 && $message['duration'] < $min) {
                $min = $message['duration'];
            }
        }
        return $min;
    }

    /**
     * Get notes
     *
     * @param array $midiEventMessages
     * @return array
     */
    protected function getNotes($midiEventMessages)
    {
        $messages = array();
        foreach ($midiEventMessages as $message) {
            if ($message['event'] == 'On' || $message['event'] == 'Off') {
                $messages[] = $message;
            }
        }
        return $messages;
    }
    
    /**
     * Get identification
     *
     * @param string $copyright
     * @return Identification
     */
    public function getIdentification($copyright = "")
    {
        $identification = new Identification();

        $rights = new Rights();
        $rights->textContent = $copyright;
        $rights->type = 'music';
        
        $identification->rights = array($rights);

        $encoding = new Encoding();
        $encoding->encodingDate = array(new EncodingDate(new DateTime()));
        $encoding->software = array(new Software(self::SOFTWARE_NAME));
        $encoding->encoder = array(new Encoder('music'));
        $encoding->encodingDescription = array(new EncodingDescription(self::ENCODING_DESCRIPTION));

        $support = array();
        $support[] = new Supports(array('element' => 'accidental', 'type' => 'yes'));
        $support[] = new Supports(array('element' => 'beam', 'type' => 'yes'));
        $support[] = new Supports(array('element' => 'print', 'attribute' => 'new-page', 'type' => 'no'));
        $support[] = new Supports(array('element' => 'print', 'attribute' => 'new-system', 'type' => 'no'));
        $support[] = new Supports(array('element' => 'stem', 'type' => 'yes'));

        $encoding->supports = $support;
        $identification->encoding = $encoding;

        return $identification;
    }
    protected $instrumentList = array(
        0 => array('Piano', 'Pno.', 'keyboard.piano'),
        1 => array('Bright Piano', 'B. Pno.'),
        2 => array('Electric Grand', 'E. G. Pno.'),
        3 => array('Honky Tonk Piano', 'H. T. Pno'),
        4 => array('Electric Piano 1', 'E. Pno1.'),
        5 => array('Electric Piano 2', 'E. Pno2.'),
        6 => array('Harpsichord', 'Haspchord'),
        7 => array('Clavinet', ''),
        8 => array('Celesta', ''),
        9 => array('Glockenspiel', ''),
        10 => array('Music Box', ''),
        11 => array('Vibraphone', ''),
        12 => array('Marimba', ''),
        13 => array('Xylophone', ''),
        14 => array('Tubular Bell', ''),
        15 => array('Dulcimer', ''),
        16 => array('Hammond Organ', ''),
        17 => array('Perc Organ', ''),
        18 => array('Rock Organ', ''),
        19 => array('Church Organ', ''),
        20 => array('Reed Organ', ''),
        21 => array('Accordion', ''),
        22 => array('Harmonica', ''),
        23 => array('Tango Accordion', ''),
        24 => array('Classical Guitar', 'Guit.', 'pluck.guitar.nylon-string'),
        25 => array('Acoustic Guitar', 'Guit.', 'pluck.guitar.acoustic'),
        26 => array('Jazz Electric Gtr', 'J. El. Guit.', 'pluck.guitar.electric'),
        27 => array('Electric Guitar', 'El. Guit.', 'pluck.guitar.electric'), //NOSONAR
        28 => array('Muted Guitar', ''),
        29 => array('Electric Guitar', 'El. Guit.', 'pluck.guitar.electric'),
        30 => array('Electric Guitar', 'El. Guit.', 'pluck.guitar.electric'),
        31 => array('Guitar Harmonics', ''),
        32 => array('Acoustic Bass', ''),
        33 => array('5-str. Electric Bass', 'El. B', 'pluck.bass.electric'),
        34 => array('Bass Guitar', 'B. Guit.', 'pluck.bass'),
        35 => array('Fretless Bass', ''),
        36 => array('Slap Bass 1', ''),
        37 => array('Slap Bass 2', ''),
        38 => array('Syn Bass 1', ''),
        39 => array('Syn Bass 2', ''),
        40 => array('Violin', ''),
        41 => array('Viola', ''),
        42 => array('Cello', ''),
        43 => array('Contrabass', ''),
        44 => array('Tremolo Strings', ''),
        45 => array('Pizzicato Strings', ''),
        46 => array('Harp', 'Hrp.', 'pluck.harp'),
        47 => array('Timpani', ''),
        48 => array('Violins (section)', 'Vlns.', 'strings.group'),
        49 => array('Strings', 'St.', 'strings.group'),
        50 => array('Synth Strings 1', ''),
        51 => array('Synth Strings 2', ''),
        52 => array('Choir Aahs', ''),
        53 => array('Boy Soprano', 'B. S.', 'voice.child'),
        54 => array('Syn Choir', ''),
        55 => array('Brass Synthesizer', 'Synth.', 'brass.group.synth'),
        56 => array('Trumpet', ''),
        57 => array('Trombone', ''),
        58 => array('Tuba', ''),
        59 => array('Muted Trumpet', ''),
        60 => array('French Horn', ''),
        61 => array('Brass Ensemble', ''),
        62 => array('Syn Brass 1', ''),
        63 => array('Syn Brass 2', ''),
        64 => array('Soprano Sax', ''),
        65 => array('Alto Sax', ''),
        66 => array('Tenor Sax', ''),
        67 => array('Baritone Sax', ''),
        68 => array('Oboe', ''),
        69 => array('English Horn', ''),
        70 => array('Bassoon', ''),
        71 => array('Clarinet', ''),
        72 => array('Piccolo', ''),
        73 => array('Flute', ''),
        74 => array('Recorder', ''),
        75 => array('Pan Flute', ''),
        76 => array('Bottle Blow', ''),
        77 => array('Shakuhachi', ''),
        78 => array('Whistle', ''),
        79 => array('Ocarina', ''),
        80 => array('Syn Square Wave', ''),
        81 => array('Syn Saw Wave', ''),
        82 => array('Effect Synthesizer', 'Synth.', 'synth.effects'),
        83 => array('Syn Chiff', ''),
        84 => array('Syn Charang', ''),
        85 => array('Syn Voice', ''),
        86 => array('Syn Fifths Saw', ''),
        87 => array('Syn Brass and Lead', ''),
        88 => array('Fantasia', ''),
        89 => array('Warm Pad', ''),
        90 => array('Polysynth', ''),
        91 => array('Space Vox', ''),
        92 => array('Bowed Glass', ''),
        93 => array('Metal Pad', ''),
        94 => array('Halo Pad', ''),
        95 => array('Sweep Pad', ''),
        96 => array('Ice Rain', ''),
        97 => array('Soundtrack', ''),
        98 => array('Crystal', ''),
        99 => array('Atmosphere', ''),
        100 => array('Brightness', ''),
        101 => array('Goblins', ''),
        102 => array('Echo Drops', ''),
        103 => array('Sci Fi', ''),
        104 => array('Sitar', ''),
        105 => array('Banjo', ''),
        106 => array('Shamisen', ''),
        107 => array('Koto', ''),
        108 => array('Kalimba', ''),
        109 => array('Bag Pipe', ''),
        110 => array('Fiddle', ''),
        111 => array('Shanai', ''),
        112 => array('Tinkle Bell', ''),
        113 => array('Agogo', ''),
        114 => array('Steel Drums', ''),
        115 => array('Woodblock', ''),
        116 => array('Taiko Drum', ''),
        117 => array('Melodic Tom', ''),
        118 => array('Syn Drum', ''),
        119 => array('Reverse Cymbal', ''),
        120 => array('Guitar Fret Noise', ''),
        121 => array('Breath Noise', ''),
        122 => array('Seashore', ''),
        123 => array('Bird', ''),
        124 => array('Telephone', ''),
        125 => array('Helicopter', ''),
        126 => array('Applause', ''),
        127 => array('Gunshot', '')
    );

    protected $drumSet = array(
        25 => array('Automobile Brake Drums', 'Aut. Brk. Dr.'),
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

    /**
     * Instrument sound list
     * Source: https://www.w3.org/2021/06/musicxml40/listings/sounds.xml/
     *
     * @var array
     */
    protected $instrumentSoundList = array(
        "brass.alphorn",
        "brass.alto-horn",
        "brass.baritone-horn",
        "brass.bugle",
        "brass.bugle.alto",
        "brass.bugle.baritone",
        "brass.bugle.contrabass",
        "brass.bugle.euphonium-bugle",
        "brass.bugle.mellophone-bugle",
        "brass.bugle.soprano",
        "brass.cimbasso",
        "brass.conch-shell",
        "brass.cornet",
        "brass.cornet.soprano",
        "brass.cornett",
        "brass.cornett.tenor",
        "brass.cornettino",
        "brass.didgeridoo",
        "brass.euphonium",
        "brass.fiscorn",
        "brass.flugelhorn",
        "brass.french-horn",
        "brass.group",
        "brass.group.synth",
        "brass.helicon",
        "brass.horagai",
        "brass.kuhlohorn",
        "brass.mellophone",
        "brass.natural-horn",
        "brass.ophicleide",
        "brass.posthorn",
        "brass.rag-dung",
        "brass.sackbutt",
        "brass.sackbutt.alto",
        "brass.sackbutt.bass",
        "brass.sackbutt.tenor",
        "brass.saxhorn",
        "brass.serpent",
        "brass.shofar",
        "brass.sousaphone",
        "brass.trombone",
        "brass.trombone.alto",
        "brass.trombone.bass",
        "brass.trombone.contrabass",
        "brass.trombone.tenor",
        "brass.trumpet",
        "brass.trumpet.baroque",
        "brass.trumpet.bass",
        "brass.trumpet.bflat",
        "brass.trumpet.c",
        "brass.trumpet.d",
        "brass.trumpet.piccolo",
        "brass.trumpet.pocket",
        "brass.trumpet.slide",
        "brass.trumpet.tenor",
        "brass.tuba",
        "brass.tuba.bass",
        "brass.tuba.subcontrabass",
        "brass.vienna-horn",
        "brass.vuvuzela",
        "brass.wagner-tuba",
        "drum.apentemma",
        "drum.ashiko",
        "drum.atabaque",
        "drum.atoke",
        "drum.atsimevu",
        "drum.axatse",
        "drum.bass-drum",
        "drum.bata",
        "drum.bata.itotele",
        "drum.bata.iya",
        "drum.bata.okonkolo",
        "drum.bendir",
        "drum.bodhran",
        "drum.bombo",
        "drum.bongo",
        "drum.bougarabou",
        "drum.buffalo-drum",
        "drum.cajon",
        "drum.chenda",
        "drum.chu-daiko",
        "drum.conga",
        "drum.cuica",
        "drum.dabakan",
        "drum.daff",
        "drum.dafli",
        "drum.daibyosi",
        "drum.damroo",
        "drum.darabuka",
        "drum.def",
        "drum.dhol",
        "drum.dholak",
        "drum.djembe",
        "drum.doira",
        "drum.dondo",
        "drum.doun-doun-ba",
        "drum.duff",
        "drum.dumbek",
        "drum.fontomfrom",
        "drum.frame-drum",
        "drum.frame-drum.arabian",
        "drum.geduk",
        "drum.ghatam",
        "drum.gome",
        "drum.group",
        "drum.group.chinese",
        "drum.group.ewe",
        "drum.group.indian",
        "drum.group.set",
        "drum.hand-drum",
        "drum.hira-daiko",
        "drum.ibo",
        "drum.igihumurizo",
        "drum.inyahura",
        "drum.ishakwe",
        "drum.jang-gu",
        "drum.kagan",
        "drum.kakko",
        "drum.kanjira",
        "drum.kendhang",
        "drum.kendhang.ageng",
        "drum.kendhang.ciblon",
        "drum.kenkeni",
        "drum.khol",
        "drum.kick-drum",
        "drum.kidi",
        "drum.ko-daiko",
        "drum.kpanlogo",
        "drum.kudum",
        "drum.lambeg",
        "drum.lion-drum",
        "drum.log-drum",
        "drum.log-drum.african",
        "drum.log-drum.native",
        "drum.log-drum.nigerian",
        "drum.madal",
        "drum.maddale",
        "drum.mridangam",
        "drum.naal",
        "drum.nagado-daiko",
        "drum.nagara",
        "drum.naqara",
        "drum.o-daiko",
        "drum.okawa",
        "drum.okedo-daiko",
        "drum.pahu-hula",
        "drum.pakhawaj",
        "drum.pandeiro",
        "drum.pandero",
        "drum.powwow",
        "drum.pueblo",
        "drum.repinique",
        "drum.riq",
        "drum.rototom",
        "drum.sabar",
        "drum.sakara",
        "drum.sampho",
        "drum.sangban",
        "drum.shime-daiko",
        "drum.slit-drum",
        "drum.slit-drum.krin",
        "drum.snare-drum",
        "drum.snare-drum.electric",
        "drum.sogo",
        "drum.surdo",
        "drum.tabla",
        "drum.tabla.bayan",
        "drum.tabla.dayan",
        "drum.tabor",
        "drum.taiko",
        "drum.talking",
        "drum.tama",
        "drum.tamborim",
        "drum.tamborita",
        "drum.tambourine",
        "drum.tamte",
        "drum.tangku",
        "drum.tan-tan",
        "drum.taphon",
        "drum.tar",
        "drum.tasha",
        "drum.tenor-drum",
        "drum.teponaxtli",
        "drum.thavil",
        "drum.the-box",
        "drum.timbale",
        "drum.timpani",
        "drum.tinaja",
        "drum.toere",
        "drum.tombak",
        "drum.tom-tom",
        "drum.tom-tom.synth",
        "drum.tsuzumi",
        "drum.tumbak",
        "drum.uchiwa-daiko",
        "drum.udaku",
        "drum.udu",
        "drum.zarb",
        "effect.aeolian-harp",
        "effect.air-horn",
        "effect.applause",
        "effect.bass-string-slap",
        "effect.bird",
        "effect.bird.nightingale",
        "effect.bird.tweet",
        "effect.breath",
        "effect.bubble",
        "effect.bullroarer",
        "effect.burst",
        "effect.car",
        "effect.car.crash",
        "effect.car.engine",
        "effect.car.pass",
        "effect.car.stop",
        "effect.crickets",
        "effect.dog",
        "effect.door.creak",
        "effect.door.slam",
        "effect.explosion",
        "effect.flute-key-click",
        "effect.footsteps",
        "effect.frogs",
        "effect.guitar-cutting",
        "effect.guitar-fret",
        "effect.gunshot",
        "effect.hand-clap",
        "effect.heartbeat",
        "effect.helicopter",
        "effect.high-q",
        "effect.horse-gallop",
        "effect.jet-plane",
        "effect.laser-gun",
        "effect.laugh",
        "effect.lions-roar",
        "effect.machine-gun",
        "effect.marching-machine",
        "effect.metronome-bell",
        "effect.metronome-click",
        "effect.pat",
        "effect.punch",
        "effect.rain",
        "effect.scratch",
        "effect.scream",
        "effect.seashore",
        "effect.siren",
        "effect.slap",
        "effect.snap",
        "effect.stamp",
        "effect.starship",
        "effect.stream",
        "effect.telephone-ring",
        "effect.thunder",
        "effect.train",
        "effect.trash-can",
        "effect.whip",
        "effect.whistle",
        "effect.whistle.mouth-siren",
        "effect.whistle.police",
        "effect.whistle.slide",
        "effect.whistle.train",
        "effect.wind",
        "keyboard.accordion",
        "keyboard.bandoneon",
        "keyboard.celesta",
        "keyboard.clavichord",
        "keyboard.clavichord.synth",
        "keyboard.concertina",
        "keyboard.fortepiano",
        "keyboard.harmonium",
        "keyboard.harpsichord",
        "keyboard.ondes-martenot",
        "keyboard.organ",
        "keyboard.organ.drawbar",
        "keyboard.organ.percussive",
        "keyboard.organ.pipe",
        "keyboard.organ.reed",
        "keyboard.organ.rotary",
        "keyboard.piano",
        "keyboard.piano.electric",
        "keyboard.piano.grand",
        "keyboard.piano.honky-tonk",
        "keyboard.piano.prepared",
        "keyboard.piano.toy",
        "keyboard.piano.upright",
        "keyboard.virginal",
        "metal.adodo",
        "metal.anvil",
        "metal.babendil",
        "metal.bells.agogo",
        "metal.bells.almglocken",
        "metal.bells.bell-plate",
        "metal.bells.bell-tree",
        "metal.bells.carillon",
        "metal.bells.chimes",
        "metal.bells.chimta",
        "metal.bells.chippli",
        "metal.bells.church",
        "metal.bells.cowbell",
        "metal.bells.dawuro",
        "metal.bells.gankokwe",
        "metal.bells.ghungroo",
        "metal.bells.hatheli",
        "metal.bells.jingle-bell",
        "metal.bells.khartal",
        "metal.bells.mark-tree",
        "metal.bells.sistrum",
        "metal.bells.sleigh-bells",
        "metal.bells.temple",
        "metal.bells.tibetan",
        "metal.bells.tinklebell",
        "metal.bells.trychel",
        "metal.bells.wind-chimes",
        "metal.bells.zills",
        "metal.berimbau",
        "metal.brake-drums",
        "metal.crotales",
        "metal.cymbal.bo",
        "metal.cymbal.ceng-ceng",
        "metal.cymbal.chabara",
        "metal.cymbal.chinese",
        "metal.cymbal.ching",
        "metal.cymbal.clash",
        "metal.cymbal.crash",
        "metal.cymbal.finger",
        "metal.cymbal.hand",
        "metal.cymbal.kesi",
        "metal.cymbal.manjeera",
        "metal.cymbal.reverse",
        "metal.cymbal.ride",
        "metal.cymbal.sizzle",
        "metal.cymbal.splash",
        "metal.cymbal.suspended",
        "metal.cymbal.tebyoshi",
        "metal.cymbal.tibetan",
        "metal.cymbal.tingsha",
        "metal.flexatone",
        "metal.gong",
        "metal.gong.ageng",
        "metal.gong.agung",
        "metal.gong.chanchiki",
        "metal.gong.chinese",
        "metal.gong.gandingan",
        "metal.gong.kempul",
        "metal.gong.kempyang",
        "metal.gong.ketuk",
        "metal.gong.kkwenggwari",
        "metal.gong.luo",
        "metal.gong.singing",
        "metal.gong.thai",
        "metal.guira",
        "metal.hang",
        "metal.hi-hat",
        "metal.jaw-harp",
        "metal.kengong",
        "metal.murchang",
        "metal.musical-saw",
        "metal.singing-bowl",
        "metal.spoons",
        "metal.steel-drums",
        "metal.tamtam",
        "metal.thundersheet",
        "metal.triangle",
        "metal.washboard",
        "pitched-percussion.angklung",
        "pitched-percussion.balafon",
        "pitched-percussion.bell-lyre",
        "pitched-percussion.bells",
        "pitched-percussion.bianqing",
        "pitched-percussion.bianzhong",
        "pitched-percussion.bonang",
        "pitched-percussion.cimbalom",
        "pitched-percussion.crystal-glasses",
        "pitched-percussion.dan-tam-thap-luc",
        "pitched-percussion.fangxiang",
        "pitched-percussion.gandingan-a-kayo",
        "pitched-percussion.gangsa",
        "pitched-percussion.gender",
        "pitched-percussion.giying",
        "pitched-percussion.glass-harmonica",
        "pitched-percussion.glockenspiel",
        "pitched-percussion.glockenspiel.alto",
        "pitched-percussion.glockenspiel.soprano",
        "pitched-percussion.gyil",
        "pitched-percussion.hammer-dulcimer",
        "pitched-percussion.handbells",
        "pitched-percussion.handchimes",
        "pitched-percussion.kalimba",
        "pitched-percussion.kantil",
        "pitched-percussion.khim",
        "pitched-percussion.kulintang",
        "pitched-percussion.kulintang-a-kayo",
        "pitched-percussion.kulintang-a-tiniok",
        "pitched-percussion.likembe",
        "pitched-percussion.luntang",
        "pitched-percussion.marimba",
        "pitched-percussion.marimba.bass",
        "pitched-percussion.mbira",
        "pitched-percussion.mbira.array",
        "pitched-percussion.metallophone",
        "pitched-percussion.metallophone.alto",
        "pitched-percussion.metallophone.bass",
        "pitched-percussion.metallophone.soprano",
        "pitched-percussion.music-box",
        "pitched-percussion.pelog-panerus",
        "pitched-percussion.pemade",
        "pitched-percussion.penyacah",
        "pitched-percussion.ranat.ek",
        "pitched-percussion.ranat.ek-lek",
        "pitched-percussion.ranat.thum",
        "pitched-percussion.ranat.thum-lek",
        "pitched-percussion.reyong",
        "pitched-percussion.sanza",
        "pitched-percussion.saron-barung",
        "pitched-percussion.saron-demong",
        "pitched-percussion.saron-panerus",
        "pitched-percussion.slendro-panerus",
        "pitched-percussion.slentem",
        "pitched-percussion.tsymbaly",
        "pitched-percussion.tubes",
        "pitched-percussion.tubular-bells",
        "pitched-percussion.vibraphone",
        "pitched-percussion.xylophone",
        "pitched-percussion.xylophone.alto",
        "pitched-percussion.xylophone.bass",
        "pitched-percussion.xylophone.soprano",
        "pitched-percussion.xylorimba",
        "pitched-percussion.yangqin",
        "pluck.archlute",
        "pluck.autoharp",
        "pluck.baglama",
        "pluck.bajo",
        "pluck.balalaika",
        "pluck.balalaika.alto",
        "pluck.balalaika.bass",
        "pluck.balalaika.contrabass",
        "pluck.balalaika.piccolo",
        "pluck.balalaika.prima",
        "pluck.balalaika.secunda",
        "pluck.bandola",
        "pluck.bandura",
        "pluck.bandurria",
        "pluck.banjo",
        "pluck.banjo.tenor",
        "pluck.banjolele",
        "pluck.barbat",
        "pluck.bass",
        "pluck.bass.acoustic",
        "pluck.bass.bolon",
        "pluck.bass.electric",
        "pluck.bass.fretless",
        "pluck.bass.guitarron",
        "pluck.bass.synth",
        "pluck.bass.synth.lead",
        "pluck.bass.washtub",
        "pluck.bass.whamola",
        "pluck.begena",
        "pluck.biwa",
        "pluck.bordonua",
        "pluck.bouzouki",
        "pluck.bouzouki.irish",
        "pluck.cavaquinho",
        "pluck.celtic-harp",
        "pluck.charango",
        "pluck.chitarra-battente",
        "pluck.cithara",
        "pluck.cittern",
        "pluck.cuatro",
        "pluck.dan-bau",
        "pluck.dan-nguyet",
        "pluck.dan-tranh",
        "pluck.dan-ty-ba",
        "pluck.diddley-bow",
        "pluck.domra",
        "pluck.domu",
        "pluck.dulcimer",
        "pluck.dutar",
        "pluck.duxianqin",
        "pluck.ektara",
        "pluck.geomungo",
        "pluck.gottuvadhyam",
        "pluck.guitar",
        "pluck.guitar.acoustic",
        "pluck.guitar.electric",
        "pluck.guitar.nylon-string",
        "pluck.guitar.pedal-steel",
        "pluck.guitar.portuguese",
        "pluck.guitar.requinto",
        "pluck.guitar.resonator",
        "pluck.guitar.steel-string",
        "pluck.guitjo",
        "pluck.guitjo.double-neck",
        "pluck.guqin",
        "pluck.guzheng",
        "pluck.guzheng.choazhou",
        "pluck.harp",
        "pluck.harp-guitar",
        "pluck.huapanguera",
        "pluck.jarana-huasteca",
        "pluck.jarana-jarocha",
        "pluck.jarana-jarocha.mosquito",
        "pluck.jarana-jarocha.primera",
        "pluck.jarana-jarocha.segunda",
        "pluck.jarana-jarocha.tercera",
        "pluck.kabosy",
        "pluck.kantele",
        "pluck.kanun",
        "pluck.kayagum",
        "pluck.kobza",
        "pluck.komuz",
        "pluck.kora",
        "pluck.koto",
        "pluck.kutiyapi",
        "pluck.langeleik",
        "pluck.laud",
        "pluck.lute",
        "pluck.lyre",
        "pluck.mandobass",
        "pluck.mandocello",
        "pluck.mandola",
        "pluck.mandolin",
        "pluck.mandolin.octave",
        "pluck.mandora",
        "pluck.mandore",
        "pluck.marovany",
        "pluck.musical-bow",
        "pluck.ngoni",
        "pluck.oud",
        "pluck.pipa",
        "pluck.psaltery",
        "pluck.ruan",
        "pluck.sallaneh",
        "pluck.sanshin",
        "pluck.santoor",
        "pluck.sanxian",
        "pluck.sarod",
        "pluck.saung",
        "pluck.saz",
        "pluck.se",
        "pluck.setar",
        "pluck.shamisen",
        "pluck.sitar",
        "pluck.synth",
        "pluck.synth.charang",
        "pluck.synth.chiff",
        "pluck.synth.stick",
        "pluck.tambura",
        "pluck.tambura.bulgarian",
        "pluck.tambura.female",
        "pluck.tambura.male",
        "pluck.tar",
        "pluck.theorbo",
        "pluck.timple",
        "pluck.tiple",
        "pluck.tres",
        "pluck.ukulele",
        "pluck.ukulele.tenor",
        "pluck.valiha",
        "pluck.veena",
        "pluck.veena.mohan",
        "pluck.veena.rudra",
        "pluck.veena.vichitra",
        "pluck.vihuela",
        "pluck.vihuela.mexican",
        "pluck.xalam",
        "pluck.yueqin",
        "pluck.zither",
        "pluck.zither.overtone",
        "rattle.afoxe",
        "rattle.birds",
        "rattle.cabasa",
        "rattle.caxixi",
        "rattle.cog",
        "rattle.ganza",
        "rattle.hosho",
        "rattle.jawbone",
        "rattle.kayamba",
        "rattle.kpoko-kpoko",
        "rattle.lava-stones",
        "rattle.maraca",
        "rattle.rain-stick",
        "rattle.ratchet",
        "rattle.rattle",
        "rattle.shaker",
        "rattle.shaker.egg",
        "rattle.shekere",
        "rattle.sistre",
        "rattle.televi",
        "rattle.vibraslap",
        "rattle.wasembe",
        "strings.ajaeng",
        "strings.arpeggione",
        "strings.baryton",
        "strings.cello",
        "strings.cello.piccolo",
        "strings.contrabass",
        "strings.crwth",
        "strings.dan-gao",
        "strings.dihu",
        "strings.erhu",
        "strings.erxian",
        "strings.esraj",
        "strings.fiddle",
        "strings.fiddle.hardanger",
        "strings.gadulka",
        "strings.gaohu",
        "strings.gehu",
        "strings.group",
        "strings.group.synth",
        "strings.haegeum",
        "strings.hurdy-gurdy",
        "strings.igil",
        "strings.kamancha",
        "strings.kokyu",
        "strings.laruan",
        "strings.leiqin",
        "strings.lirone",
        "strings.lyra.byzantine",
        "strings.lyra.cretan",
        "strings.morin-khuur",
        "strings.nyckelharpa",
        "strings.octobass",
        "strings.rebab",
        "strings.rebec",
        "strings.sarangi",
        "strings.stroh-violin",
        "strings.tromba-marina",
        "strings.vielle",
        "strings.viol",
        "strings.viol.alto",
        "strings.viol.bass",
        "strings.viol.tenor",
        "strings.viol.treble",
        "strings.viol.violone",
        "strings.viola",
        "strings.viola-damore",
        "strings.violin",
        "strings.violono.piccolo",
        "strings.violotta",
        "strings.yayli-tanbur",
        "strings.yazheng",
        "strings.zhonghu",
        "synth.effects",
        "synth.effects.atmosphere",
        "synth.effects.brightness",
        "synth.effects.crystal",
        "synth.effects.echoes",
        "synth.effects.goblins",
        "synth.effects.rain",
        "synth.effects.sci-fi",
        "synth.effects.soundtrack",
        "synth.group",
        "synth.group.fifths",
        "synth.group.orchestra",
        "synth.pad",
        "synth.pad.bowed",
        "synth.pad.choir",
        "synth.pad.halo",
        "synth.pad.metallic",
        "synth.pad.polysynth",
        "synth.pad.sweep",
        "synth.pad.warm",
        "synth.theremin",
        "synth.tone.sawtooth",
        "synth.tone.sine",
        "synth.tone.square",
        "voice.aa",
        "voice.alto",
        "voice.aw",
        "voice.baritone",
        "voice.bass",
        "voice.child",
        "voice.countertenor",
        "voice.doo",
        "voice.ee",
        "voice.female",
        "voice.kazoo",
        "voice.male",
        "voice.mezzo-soprano",
        "voice.mm",
        "voice.oo",
        "voice.percussion",
        "voice.percussion.beatbox",
        "voice.soprano",
        "voice.synth",
        "voice.talk-box",
        "voice.tenor",
        "voice.vocals",
        "wind.flutes.bansuri",
        "wind.flutes.blown-bottle",
        "wind.flutes.calliope",
        "wind.flutes.danso",
        "wind.flutes.di-zi",
        "wind.flutes.dvojnice",
        "wind.flutes.fife",
        "wind.flutes.flageolet",
        "wind.flutes.flute",
        "wind.flutes.flute.alto",
        "wind.flutes.flute.bass",
        "wind.flutes.flute.contra-alto",
        "wind.flutes.flute.contrabass",
        "wind.flutes.flute.double-contrabass",
        "wind.flutes.flute.irish",
        "wind.flutes.flute.piccolo",
        "wind.flutes.flute.subcontrabass",
        "wind.flutes.fujara",
        "wind.flutes.gemshorn",
        "wind.flutes.hocchiku",
        "wind.flutes.hun",
        "wind.flutes.kaval",
        "wind.flutes.kawala",
        "wind.flutes.khlui",
        "wind.flutes.knotweed",
        "wind.flutes.koncovka.alto",
        "wind.flutes.koudi",
        "wind.flutes.ney",
        "wind.flutes.nohkan",
        "wind.flutes.nose",
        "wind.flutes.ocarina",
        "wind.flutes.overtone.tenor",
        "wind.flutes.palendag",
        "wind.flutes.panpipes",
        "wind.flutes.quena",
        "wind.flutes.recorder",
        "wind.flutes.recorder.alto",
        "wind.flutes.recorder.bass",
        "wind.flutes.recorder.contrabass",
        "wind.flutes.recorder.descant",
        "wind.flutes.recorder.garklein",
        "wind.flutes.recorder.great-bass",
        "wind.flutes.recorder.sopranino",
        "wind.flutes.recorder.soprano",
        "wind.flutes.recorder.tenor",
        "wind.flutes.ryuteki",
        "wind.flutes.shakuhachi",
        "wind.flutes.shepherds-pipe",
        "wind.flutes.shinobue",
        "wind.flutes.shvi",
        "wind.flutes.suling",
        "wind.flutes.tarka",
        "wind.flutes.tumpong",
        "wind.flutes.venu",
        "wind.flutes.whistle",
        "wind.flutes.whistle.alto",
        "wind.flutes.whistle.low-irish",
        "wind.flutes.whistle.shiva",
        "wind.flutes.whistle.slide",
        "wind.flutes.whistle.tin",
        "wind.flutes.whistle.tin.bflat",
        "wind.flutes.whistle.tin.c",
        "wind.flutes.whistle.tin.d",
        "wind.flutes.xiao",
        "wind.flutes.xun",
        "wind.group",
        "wind.jug",
        "wind.pipes.bagpipes",
        "wind.pipes.gaida",
        "wind.pipes.highland",
        "wind.pipes.uilleann",
        "wind.pungi",
        "wind.reed.albogue",
        "wind.reed.alboka",
        "wind.reed.algaita",
        "wind.reed.arghul",
        "wind.reed.basset-horn",
        "wind.reed.bassoon",
        "wind.reed.bawu",
        "wind.reed.bifora",
        "wind.reed.bombarde",
        "wind.reed.chalumeau",
        "wind.reed.clarinet",
        "wind.reed.clarinet.a",
        "wind.reed.clarinet.alto",
        "wind.reed.clarinet.bass",
        "wind.reed.clarinet.basset",
        "wind.reed.clarinet.bflat",
        "wind.reed.clarinet.contra-alto",
        "wind.reed.clarinet.contrabass",
        "wind.reed.clarinet.d",
        "wind.reed.clarinet.eflat",
        "wind.reed.clarinet.g",
        "wind.reed.clarinet.piccolo",
        "wind.reed.clarinet.piccolo.aflat",
        "wind.reed.clarinette-damour",
        "wind.reed.contrabass",
        "wind.reed.contrabassoon",
        "wind.reed.cornamuse",
        "wind.reed.cromorne",
        "wind.reed.crumhorn",
        "wind.reed.crumhorn.alto",
        "wind.reed.crumhorn.bass",
        "wind.reed.crumhorn.great-bass",
        "wind.reed.crumhorn.soprano",
        "wind.reed.crumhorn.tenor",
        "wind.reed.diple",
        "wind.reed.diplica",
        "wind.reed.duduk",
        "wind.reed.dulcian",
        "wind.reed.dulzaina",
        "wind.reed.english-horn",
        "wind.reed.guanzi",
        "wind.reed.harmonica",
        "wind.reed.harmonica.bass",
        "wind.reed.heckel-clarina",
        "wind.reed.heckelphone",
        "wind.reed.heckelphone.piccolo",
        "wind.reed.heckelphone-clarinet",
        "wind.reed.hichiriki",
        "wind.reed.hirtenschalmei",
        "wind.reed.hne",
        "wind.reed.hornpipe",
        "wind.reed.houguan",
        "wind.reed.hulusi",
        "wind.reed.jogi-baja",
        "wind.reed.ken-bau",
        "wind.reed.khaen-mouth-organ",
        "wind.reed.launeddas",
        "wind.reed.maqrunah",
        "wind.reed.melodica",
        "wind.reed.mijwiz",
        "wind.reed.mizmar",
        "wind.reed.nadaswaram",
        "wind.reed.oboe",
        "wind.reed.oboe.bass",
        "wind.reed.oboe.piccolo",
        "wind.reed.oboe-da-caccia",
        "wind.reed.oboe-damore",
        "wind.reed.octavin",
        "wind.reed.pi",
        "wind.reed.pibgorn",
        "wind.reed.piri",
        "wind.reed.rackett",
        "wind.reed.rauschpfeife",
        "wind.reed.rhaita",
        "wind.reed.rothphone",
        "wind.reed.sarrusaphone",
        "wind.reed.saxonette",
        "wind.reed.saxophone",
        "wind.reed.saxophone.alto",
        "wind.reed.saxophone.aulochrome",
        "wind.reed.saxophone.baritone",
        "wind.reed.saxophone.bass",
        "wind.reed.saxophone.contrabass",
        "wind.reed.saxophone.melody",
        "wind.reed.saxophone.mezzo-soprano",
        "wind.reed.saxophone.sopranino",
        "wind.reed.saxophone.sopranissimo",
        "wind.reed.saxophone.soprano",
        "wind.reed.saxophone.subcontrabass",
        "wind.reed.saxophone.tenor",
        "wind.reed.shawm",
        "wind.reed.shenai",
        "wind.reed.sheng",
        "wind.reed.sipsi",
        "wind.reed.sopila",
        "wind.reed.sorna",
        "wind.reed.sralai",
        "wind.reed.suona",
        "wind.reed.surnai",
        "wind.reed.taepyeongso",
        "wind.reed.tarogato",
        "wind.reed.tarogato.ancient",
        "wind.reed.trompeta-china",
        "wind.reed.tubax",
        "wind.reed.xaphoon",
        "wind.reed.zhaleika",
        "wind.reed.zurla",
        "wind.reed.zurna",
        "wood.agogo-block",
        "wood.agung-a-tamlang",
        "wood.ahoko",
        "wood.bones",
        "wood.castanets",
        "wood.claves",
        "wood.drum-sticks",
        "wood.gourd",
        "wood.granite-block",
        "wood.guban",
        "wood.guiro",
        "wood.hyoushigi",
        "wood.ipu",
        "wood.jam-block",
        "wood.kaekeeke",
        "wood.kagul",
        "wood.kalaau",
        "wood.kashiklar",
        "wood.kubing",
        "wood.pan-clappers",
        "wood.sand-block",
        "wood.slapstick",
        "wood.stir-drum",
        "wood.temple-block",
        "wood.tic-toc-block",
        "wood.tonetang",
        "wood.wood-block"
    );

    public function getIsntrumentSound($channelId, $programId, $instrumentName)
    {
        $array = explode(" ", strtolower($instrumentName));
        return $this->match1($array, $channelId, $programId, $instrumentName);
    }

    /**
     * Check instrument name
     *
     * @param array $explodedName
     * @param integer $channelId
     * @param integer $programId
     * @param string $instrumentName
     * @return string|null
     */
    protected function match1($explodedName, $channelId, $programId, $instrumentName)
    {
        $found = array();
        foreach($explodedName as $search)
        {
            foreach($this->instrumentSoundList as $index=>$chk)
            {
                $chkArr = explode('.', $chk);
                if(in_array($search, $chkArr))
                {
                    echo "NAME = $instrumentName; SERACH = '$search', CHANNEL ID = $channelId, PROGRAM ID = $programId; $index; $chk \r\n";
                    if(!isset($found[$chk]))
                    {
                        $found[$chk] = 1;
                    }
                    else
                    {
                        $found[$chk] ++;
                    }
                }
            }
        }
        if(!empty($found))
        {
            arsort($found);
            $keys = array_keys($found);
            return $keys[0];
        }
        return null;
    }
    
}
