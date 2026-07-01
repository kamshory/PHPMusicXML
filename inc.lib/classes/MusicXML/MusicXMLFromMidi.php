<?php

namespace MusicXML;

use DOMDocument;
use DOMNode;
use Midi\MidiMeasure;
use MusicXML\Exceptions\FileNotFoundException;
use MusicXML\Model\Accidental;
use MusicXML\Model\Attributes;
use MusicXML\Model\Chord;
use MusicXML\Model\Clef;
use MusicXML\Model\DisplayOctave;
use MusicXML\Model\DisplayStep;
use MusicXML\Model\Divisions;
use MusicXML\Model\Duration;
use MusicXML\Model\InstrumentName;
use MusicXML\Model\InstrumentSound;
use MusicXML\Model\MeasurePartwise;
use MusicXML\Model\MidiChannel;
use MusicXML\Model\MidiDevice;
use MusicXML\Model\MidiInstrument;
use MusicXML\Model\MidiProgram;
use MusicXML\Model\MidiUnpitched;
use MusicXML\Model\Note;
use MusicXML\Model\Lyric;
use MusicXML\Model\PartAbbreviation;
use MusicXML\Model\PartList;
use MusicXML\Model\PartName;
use MusicXML\Model\PartPartwise;
use MusicXML\Model\Rest;
use MusicXML\Model\Rights;
use MusicXML\Model\ScoreInstrument;
use MusicXML\Model\ScorePart;
use MusicXML\Model\ScorePartwise;
use MusicXML\Model\Sign;
use MusicXML\Model\Staves;
use MusicXML\Model\Technical;
use MusicXML\Model\TextElement;
use MusicXML\Model\Tie;
use MusicXML\Model\Tied;
use MusicXML\Model\Unpitched;
use MusicXML\Model\Type;
use MusicXML\Model\Volume;
use MusicXML\Properties\MeasureDivision;
use MusicXML\Properties\MeasurePartwiseContainer;
use MusicXML\Properties\MidiEvent;
use MusicXML\Properties\TimeSignature;
use MusicXML\Util\MXL;

/**
 * Convert MIDI to MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/tutorial/midi-compatible-part/
 */
class MusicXMLFromMidi extends MusicXMLBase
{

    const DEFAULT_DIVISONS = 4;

    /**
     * Minimum chord
     *
     * @var integer
     */
    private $minChord = 10;

    /**
     * Witdh scale
     *
     * @var integer
     */
    private $widthScale = 6;

    /**
     * Minimum width
     *
     * @var integer
     */
    private $minWidth = 120;

    /**
     * Part list
     *
     * @var array
     */
    private $partList = array();

    /**
     * Part volume
     *
     * @var array
     */
    private $partVolume = array();

    /**
     * Pat pan
     *
     * @var array
     */
    private $partPan = array();

    /**
     * Measures
     *
     * @var array
     */
    private $measures = array();

    /**
     * Channel 10 instrument list
     *
     * @var array
     */
    private $channel10 = array();

    /**
     * Clef
     *
     * @var array
     */
    private $clefs = array();

    /**
     * Copyright
     *
     * @var string
     */
    private $copyright = "";

    /**
     * Time signature
     *
     * @var TimeSignature
     */
    private $timeSignature = null;
    /**
     * Division
     *
     * @var integer[]
     */
    private $measureDivisions = array();

    /**
     * Default measure width
     *
     * @var array
     */
    private $measureWidth = array();

    /**
     * Minimum note
     *
     * @var integer
     */
    private $noteMin = 127;

    /**
     * Maximum note
     *
     * @var integer
     */
    private $noteMax = 0;

    /**
     * Minimum note per channel
     * @var array
     */
    private $channelNoteMin = array();

    /**
     * Maximum note per channel
     * @var array
     */
    private $channelNoteMax = array();

    /**
     * Maximum measure
     *
     * @var integer
     */
    private $maxMeasure = 0;

    /**
     * Last note
     *
     * @var array
     */
    private $lastNote = array();

    /**
     * Tie stop
     *
     * @var array
     */
    private $tieStop = array();

    /**
     * Stores information about a note that needs to be continued with a tie in the next measure.
     *
     * @var array
     */
    private $tieContinue = array();

    /**
     * Lyrics storage
     * @var array
     */
    private $lyrics = array();

    /**
     * Selected channels to convert. If null, all channels are converted.
     *
     * @var array
     */
    private $selectedChannels = null;

    /**
     * Measure onsets and their calculated X positions
     * @var array
     */
    private $measureOnsets = array();

    /**
     * Divisions per quarter note, derived from MIDI timebase.
     * @var int
     */
    private $divisionsPerQuarter;

    /**
     * XML for log
     * 
     * @var string
     */
    private $xml = null;

    /**
     * Map of CC Volume events per channel
     * @var array
     */
    private $ccVolumeMap = array();

    /**
     * Map of CC Expression events per channel
     * @var array
     */
    private $ccExpressionMap = array();

    /**
     * Reset properties
     *
     * @return void
     */
    private function resetProperties()
    {
        $this->partList = array();
        $this->partVolume = array();
        $this->partPan = array();
        $this->measures = array();
        $this->channel10 = array();
        $this->copyright = "";
        $this->timeSignature = null;
        $this->clefs = array();
        $this->measureDivisions = array();
        $this->noteMin = 127;
        $this->noteMax = 0;
        $this->channelNoteMin = array();
        $this->channelNoteMax = array();
        $this->maxMeasure = 0;
        $this->lastNote = array();
        $this->divisionsPerQuarter = 0;
        $this->tieStop = array();
        $this->tieContinue = array();
        $this->measureOnsets = array();
        $this->lyrics = array();
        $this->ccVolumeMap = array();
        $this->ccExpressionMap = array();
    }

    /**
     * Set selected channels
     *
     * @param array $selectedChannels An array of channel numbers to be included in the conversion.
     * @return void
     */
    public function setSelectedChannels($selectedChannels)
    {
        $this->selectedChannels = $selectedChannels;
    }

    /**
     * Set note duration
     *
     * @deprecated 1.0
     * @param integer $ch The MIDI channel number.
     * @param integer $indexOn The index of the measure.
     * @param float $duration The new duration for the note.
     * @return void
     */
    public function setNoteDuration($ch, $indexOn, $duration)
    {
        $message = $this->measures[$ch][$indexOn];
        $lastOn = MusicXMLUtil::findLastOn($message);
        $this->measures[$ch][$indexOn][$lastOn]['duration'] = $duration;
    }

    /**
     * Add part list
     *
     * @param integer $channelId The MIDI channel ID (0-15).
     * @param string $partId The MusicXML part ID (e.g., "P1").
     * @param integer $programId The MIDI program ID (1-128).
     * @param string $instrumentId The MusicXML instrument ID (e.g., "P1-I1").
     * @param array $instrument An array containing the instrument's name and abbreviation.
     * @param integer $port The MIDI port number.
     * @return void
     */
    private function addPartList(
        $channelId,
        $partId,
        $programId,
        $instrumentId,
        $instrument,
        $port
    )
    {
        if ($this->selectedChannels !== null && !in_array($channelId, $this->selectedChannels)) {
            return;
        }
        $this->partList[$instrumentId] = array(
            'instrumentId' => $instrumentId,
            'channelId' => $channelId,
            'partId' => $partId,
            'programId' => $programId,
            'instrument' => $instrument,
            'port' => $port
        );
    }

    /**
     * Add ecent
     *
     * @param string $eventName The type of MIDI event (e.g., 'On', 'Off', 'PrCh', 'Tempo').
     * @param array $message The raw parsed MIDI message from the parser.
     * @param integer $timebase The MIDI file's timebase (ticks per quarter note).
     * @param integer $abstime The absolute time of the event in ticks.
     * @param mixed $n Primary value (e.g., note number, program ID, controller number).
     * @param mixed $ch Channel number.
     * @param mixed $v Secondary value (e.g., velocity, pressure, controller value).
     * @return void
     */
    private function addEvent($eventName, $message, $timebase, $abstime, $n = 0, $ch = 0, $v = 0) //NOSONAR
    {
        if ($ch > 0 && $this->selectedChannels !== null && !in_array($ch, $this->selectedChannels)) {
            return;
        }
        if(!isset($this->timeSignature))
        {
            $this->timeSignature = new TimeSignature(array(0, 'TimeSig', '4/4', 24, 8));
        }
        $rawtime = $message[0];
        $tm = $message[0] / ($this->timeSignature->getBeats() * $timebase);
        $tmInteger = (int) floor($tm);
        if($this->maxMeasure < $tmInteger)
        {
            $this->maxMeasure = $tmInteger;
        }

        $offset = $tm - $tmInteger;

        if (!isset($this->measures[$ch])) {
            $this->measures[$ch] = array();
        }
        if (!isset($this->measures[$ch][$tmInteger])) {
            $this->measures[$ch][$tmInteger] = array();
        }
        if($eventName == 'Par')
        {
            $this->measures[$ch][$tmInteger][] = array(
                'event' => $eventName,
                'message' => $message,
                'time' => $tm,
                'abstime' => $abstime,
                'rawtime' => $rawtime,
                'channel' => $ch,
                'control' => $n,
                'value' => $v
            );
        }
        else if($eventName == 'PrCh')
        {
            $this->measures[$ch][$tmInteger][] = array(
                'event' => $eventName,
                'message' => $message,
                'time' => $tm,
                'abstime' => $abstime,
                'rawtime' => $rawtime,
                'channel' => $ch,
                'number' => $n
            );
        }
        else if($eventName == 'PoPr')
        {
            $this->measures[$ch][$tmInteger][] = array(
                'event' => $eventName,
                'message' => $message,
                'time' => $tm,
                'abstime' => $abstime,
                'rawtime' => $rawtime,
                'channel' => $ch,
                'note' => $n,
                'pressure' => $v
            );
        }
        else if($eventName == 'Seqnr' || $eventName == 'Tempo')
        {
            $this->measures[0][$tmInteger][] = array(
                'event' => $eventName,
                'message' => $message,
                'time' => $tm,
                'abstime' => $abstime,
                'rawtime' => $rawtime,
                'value' => $n
            );
        }
        else if($eventName == 'KeySig')
        {
            $this->measures[0][$tmInteger][] = array(
                'event' => $eventName,
                'message' => $message,
                'time' => $tm,
                'abstime' => $abstime,
                'fifths' => $n,
                'mode' => $v
            );
        }
        else if($eventName == 'ChPr')
        {
            $this->measures[$ch][$tmInteger][] = array(
                'event' => $eventName,
                'message' => $message,
                'time' => $tm,
                'abstime' => $abstime,
                'rawtime' => $rawtime,
                'channel' => $ch,
                'pressure' => $v
            );
        }
        else if($eventName == 'Pb')
        {
            $this->measures[$ch][$tmInteger][] = array(
                'event' => $eventName,
                'message' => $message,
                'time' => $tm,
                'abstime' => $abstime,
                'rawtime' => $rawtime,
                'channel' => $ch,
                'value' => $v
            );
        }
        else if($eventName == 'On' || $eventName == 'Off')
        {
            if(!isset($this->lastNote[$ch]))
            {
                $this->lastNote[$ch] = array();
            }
            if(!isset($this->lastNote[$ch][$n]))
            {
                $this->lastNote[$ch][$n] = array();
            }
            $mod = $tm % ($timebase * $this->timeSignature->getBeats());
            $startAt = floor($mod / $timebase);
            $note = array(
                'event' => $eventName,
                'message' => $message,
                'time' => $tm,
                'abstime' => $abstime,
                'offset' => $offset,
                'channel' => $ch,
                'note' => $n,
                'value' => $v,
                'startAt' => $startAt
            );
            $index = count($this->measures[$ch][$tmInteger]);
            $lastIndex = $index;
            $this->measures[$ch][$tmInteger][$index] = $note;

            if(isset($this->lastNote[$ch][$n]) && isset($this->lastNote[$ch][$n]['index']))
            {
                $duration = $abstime - $this->lastNote[$ch][$n]['time'];
                $index = $this->lastNote[$ch][$n]['index'];
                $ti = $this->lastNote[$ch][$n]['tminteger'];
                $this->measures[$ch][$ti][$index]['duration'] = $duration;

                // Update maxMeasure based on note end time (current abstime) to prevent truncated measures
                $measureLen = $this->timeSignature->getBeats() * $timebase;
                $tmEndInteger = (int) floor(($abstime - 1) / $measureLen);
                
                if ($this->maxMeasure < $tmEndInteger) {
                    $this->maxMeasure = $tmEndInteger;
                }
            }

            $this->lastNote[$ch][$n] = array('time'=>$abstime, 'index'=>$lastIndex, 'tminteger'=>$tmInteger);

            if($ch != 10)
            {
                if(!isset($this->channelNoteMin[$ch]) || $n < $this->channelNoteMin[$ch]) {
                    $this->channelNoteMin[$ch] = $n;
                }
                if(!isset($this->channelNoteMax[$ch]) || $n > $this->channelNoteMax[$ch]) {
                    $this->channelNoteMax[$ch] = $n;
                }
                if($n < $this->noteMin)
                {
                    $this->noteMin = $n;
                }
                if($n > $this->noteMax)
                {
                    $this->noteMax = $n;
                }
            }
        }
        else if($eventName == 'Meta' && isset($message[2]) && ($message[2] == 'Lyric' || $message[2] == 'Text'))
        {
            $line = implode(' ', $message);
            if (preg_match('/"(.*)"/', $line, $matches)) {
                $lyricText = $matches[1];
                if (!isset($this->lyrics[$ch])) $this->lyrics[$ch] = array();
                if (isset($this->lyrics[$ch][$abstime])) {
                    $this->lyrics[$ch][$abstime] .= ' ' . $lyricText; // Gabungkan lirik jika ada di timestamp yang sama
                } else {
                    $this->lyrics[$ch][$abstime] = $lyricText;
                }
            }
        }
        else
        {
            $this->measures[$ch][$tmInteger][] = array(
                'event' => $eventName,
                'message' => $message,
                'time' => $tm,
                'abstime' => $abstime,
                'channel' => $ch,
                'value' => $v
            );
        }
    }

    /**
     * Load midi from file
     *
     * @param string $midiPath The file path to the MIDI file.
     * @return MidiMeasure
     */
    public function loadMidiFile($midiPath)
    {
        if(file_exists($midiPath))
        {
            $midi = new MidiMeasure();
            $midi->importMidiFile($midiPath);
            return $midi;
        }
        else
        {
            throw new FileNotFoundException("Specified file does not exists: ".$midiPath);
        }
    }

    /**
     * Load midi from string
     *
     * @param string $midiString The binary content of the MIDI file.
     * @return MidiMeasure
     */
    public function loadMidiString($midiString)
    {
        $midi = new MidiMeasure();
        $midi->parseMidi($midiString);
        return $midi;
    }


    /**
     * Convert MIDI to MusicXML
     *
     * @param MidiMeasure $midi The parsed MidiMeasure object.
     * @param string $title The title for the musical work.
     * @param string $version The MusicXML version to use (e.g., "4.0").
     * @param string $format The output format, either 'xml' or 'mxl'.
     * @return string
     */
    public function midiToMusicXml($midi, $title, $version = "4.0", $format = MXL::FORMAT_XML)
    {
        $domdoc = $this->getDOMDocument();
        $domdoc->appendChild($this->convertMidiToMusicXML($midi, $title, $domdoc, $version));
        if($format == MXL::FORMAT_MXL)
        {
            // compress MusicXML
            $mxl = new MXL();
            return $mxl->xmlToMxl($title, $domdoc->saveXML());
        }
        else
        {
            return $domdoc->saveXML();
        }
    }

    /**
     * Build part list
     *
     * @param MidiMeasure $midi The parsed MidiMeasure object.
     * @return void
     */
    private function buildPartList($midi) // NOSONAR
    {
        $timebase = $midi->getTimebase();
        $this->channel10 = array();
        $this->copyright = null;
        $tracks = $midi->getTracks();
        $tc = count($tracks);
        $xml = ""; // NOSONAR
        $ttype = 0;
        $abstime = 0;
        $dt = 0;
        $last = 0;
        $i = 0;
        $j = 0;
        for ($i = 0; $i < $tc; $i++) {
            $xml .= "<Track Number=\"$i\">\n";
            $track = $tracks[$i];
            $mc = count($track);
            $last = 0;
            for ($j = 0; $j < $mc; $j++) {
                $msg = explode(' ', $track[$j]);
                $t = (int) $msg[0];
                if ($ttype == 1) { //delta
                    $dt = $t - $last;
                    $last = $t;
                }
                $abstime = $t;
                $xml .= "  <Event>\n";
                $xml .= ($ttype == 1) ? "    <Delta>$dt</Delta>\n" : "    <Absolute>$t</Absolute>\n";
                $xml .= '    ';
                switch ($msg[1]) {
                    case 'PrCh':
                        eval("\$" . $msg[2] . ';'); // $ch
                        eval("\$" . $msg[3] . ';'); // $p
                        $ch = isset($ch) ? $ch : 0;
                        $p = isset($p) ? $p : 0;

            $instrument = MusicXMLUtil::getInstrumentName($p, $ch); // $p is program ID, $ch is channel ID

                        $partId = "P" . $ch;
                        $p1 = $p + 1;
                        $instrumentId = $ch == 10 ? "P" . $ch . "-I" . $p1 : "P" . $ch . "-I1";
                        $channelId = $ch;
                        $programId = $p1;
                        $port = $ch;

                        $this->addPartList(
                            $channelId,
                            $partId,
                            $programId,
                            $instrumentId,
                            $instrument,
                            $port
                        );
                        // add event
                        $this->addEvent($msg[1], $msg, $timebase, $abstime, $p, $ch); // $p is program ID
                        $xml .= "<controlEvents Channel=\"$ch\" Number=\"$p\"/>\n";
                        break;

                    case 'On':
                    case 'Off':
                        eval("\$" . $msg[2] . ';'); // $ch
                        eval("\$" . $msg[3] . ';'); // $n
                        eval("\$" . $msg[4] . ';'); // $v

                        $ch = isset($ch) ? $ch : 0;
                        $n = isset($n) ? $n : 0;
                        $v = isset($v) ? $v : 0;
                        if ($ch == 10 && !isset($this->channel10[$n + 1])) {
                            $this->channel10[$n + 1] = array('note' => $n, 'ch' => $ch, 'n' => $n, 'v' => $v, 'message' => $msg);
                        }
                        // add event, $n is note number, $v is velocity
                        $this->addEvent($msg[1], $msg, $timebase, $abstime, $n, $ch, $v);

                        $xml .= "<Note{$msg[1]} Channel=\"$ch\" Note=\"$n\" Velocity=\"$v\"/>\n";
                        break;

                    case 'PoPr':
                        eval("\$" . $msg[2] . ';'); // $ch
                        eval("\$" . $msg[3] . ';'); // $n
                        eval("\$" . $msg[4] . ';'); // $v

                        $ch = isset($ch) ? $ch : 0;
                        $n = isset($n) ? $n : 0;
                        $v = isset($v) ? $v : 0;

                        // add event
                        $this->addEvent($msg[1], $msg, $timebase, $abstime, $n, $ch, $v); // $n is note number, $v is pressure

                        $xml .= "<PolyKeyPressure Channel=\"$ch\" Note=\"$n\" Pressure=\"$v\"/>\n";
                        break;

                    case 'Par':
                        eval("\$" . $msg[2] . ';'); // ch
                        eval("\$" . $msg[3] . ';'); // c
                        eval("\$" . $msg[4] . ';'); // v

                        $ch = isset($ch) ? $ch : 0;
                        $c = isset($c) ? $c : 0;
                        $v = isset($v) ? $v : 0;

                        $partId = "P" . $ch;
                        if ($c == 7 && (!isset($this->partVolume[$partId]))) {
                            $this->partVolume[$partId] = $v;
                        }
                        if ($c == 10 && (!isset($this->partPan[$partId]) || $this->partPan[$partId] == 0)) {
                            $this->partPan[$partId] = $v;
                        }

                        if ($c == 7) {
                            if (!isset($this->ccVolumeMap[$ch])) {
                                $this->ccVolumeMap[$ch] = array();
                            }
                            $this->ccVolumeMap[$ch][$abstime] = $v;
                        }
                        if ($c == 11) {
                            if (!isset($this->ccExpressionMap[$ch])) {
                                $this->ccExpressionMap[$ch] = array();
                            }
                            $this->ccExpressionMap[$ch][$abstime] = $v;
                        }

                        // add event, $c is controller number, $v is value
                        $this->addEvent($msg[1], $msg, $timebase, $abstime, $c, $ch, $v);

                        $xml .= "<ControlChange Channel=\"$ch\" Control=\"$c\" Value=\"$v\"/>\n";
                        break;

                    case 'ChPr':
                        eval("\$" . $msg[2] . ';'); // ch
                        eval("\$" . $msg[3] . ';'); // v

                        $ch = isset($ch) ? $ch : 0;
                        $v = isset($v) ? $v : 0;
                        // add event, $v is pressure
                        $this->addEvent($msg[1], $msg, $timebase, $abstime, 0, $ch, $v);
                        $xml .= "<ChannelKeyPressure Channel=\"$ch\" Pressure=\"$v\"/>\n";
                        break;

                    case 'Pb':
                        eval("\$" . $msg[2] . ';'); // ch
                        eval("\$" . $msg[3] . ';'); // v

                        $ch = isset($ch) ? $ch : 0;
                        $v = isset($v) ? $v : 0;
                        $this->addEvent($msg[1], $msg, $timebase, $abstime, 0, $ch, $v); // $v is pitch bend value
                        $xml .= "<PitchBendChange Channel=\"$ch\" Value=\"$v\"/>\n";
                        break;

                    case 'Seqnr':
                        $xml .= "<SequenceNumber Value=\"{$msg[2]}\"/>\n";
                        $this->addEvent($msg[1], $msg, $timebase, $abstime, $msg[2], 0);
                        break;

                    case 'Meta':
                        $txttypes = array('Text', 'Copyright', 'TrkName', 'InstrName', 'Lyric', 'Marker', 'Cue');
                        $mtype = $msg[2];

                        $pos = array_search($mtype, $txttypes);
                        if ($pos !== false) {
                            $tags = array('TextEvent', 'CopyrightNotice', 'TrackName', 'InstrumentName', 'Lyric', 'Marker', 'CuePoint');
                            $tag = $tags[$pos];
                            $line = $track[$j];
                            $start = strpos($line, '"') + 1;
                            $end = strrpos($line, '"');
                            $txt = substr($line, $start, $end - $start);
                            $xml .= "<$tag>" . htmlspecialchars($txt) . "</$tag>\n";

                            if ($tag == 'CopyrightNotice') {
                                $this->copyright = $txt;
                            }

                            if ($tag == 'Lyric' || $tag == 'TextEvent') {
                                // Kirim event ke addEvent agar disimpan dalam $this->lyrics
                                $this->addEvent($msg[1], $msg, $timebase, $abstime, 0, 0);
                            }
                        } else {
                            if ($mtype == 'TrkEnd') {
                                $xml .= "<EndOfTrack/>\n";
                            } else if ($mtype == '0x20' || $mtype == '0x21') {
                                $xml .= "<MIDIChannelPrefix Value=\"{$msg[3]}\"/>\n";
                            }
                        }
                        break;

                    case 'Tempo':
                        $xml .= "<SetTempo Value=\"{$msg[2]}\"/>\n";
                        $this->addEvent($msg[1], $msg, $timebase, $abstime, $msg[2], 0);
                        break;

                    case 'SMPTE':
                        $xml .= "<SMPTEOffset TimeCodeType=\"1\" Hour=\"{$msg[2]}\" Minute=\"{$msg[3]}\" Second=\"{$msg[4]}\" Frame=\"{$msg[5]}\" FractionalFrame=\"{$msg[6]}\"/>\n"; //TimeCodeType???
                        break;

                    case 'TimeSig': // LogDenum???
                        $ts = explode('/', $msg[2]);
                        $this->timeSignature = new TimeSignature($msg);
                        $xml .= "<TimeSignature Numerator=\"{$ts[0]}\" LogDenominator=\"" . log($ts[1]) / log(2) . "\" MIDIClocksPerMetronomeClick=\"{$msg[3]}\" ThirtySecondsPer24Clocks=\"{$msg[4]}\"/>\n"; // NOSONAR
                        break;

                    case 'KeySig':
                        $mode = ($msg[3] == 'major') ? 0 : 1;
                        $xml .= "<KeySignature Fifths=\"{$msg[2]}\" Mode=\"$mode\"/>\n"; // ???
                        $this->addEvent($msg[1], $msg, $timebase, $abstime, intval($msg[2]), 0, $msg[3]);
                        break;

                    case 'SeqSpec':
                        $line = $track[$j];
                        $start = strpos($line, 'SeqSpec') + 8;
                        $data = substr($line, $start);
                        $xml .= "<SequencerSpecific>$data</SequencerSpecific>\n";
                        break;

                    case 'SysEx':
                        $str = '';
                        for ($k = 3; $k < count($msg); $k++) {
                            $str .= $msg[$k] . ' ';
                        }
                        $str = trim(strtoupper($str));
                        $xml .= "<SystemExclusive>$str</SystemExclusive>\n";
                        break;
                    default:
                }
                $xml .= "  </Event>\n";
            }
            $xml .= "</Track>\n";
        }
        $xml .= "</MIDIFile>";
        $this->xml = $xml;

        foreach ($this->ccVolumeMap as $ch => &$events) {
            ksort($events);
        }
        foreach ($this->ccExpressionMap as $ch => &$events) {
            ksort($events);
        }
    }

    /**
     * Get measure division
     *
     * @param integer $measureIndex The index of the measure (now unused as divisions are global).
     * @return integer
     */
    private function getDivisions($measureIndex)
    {
        return $this->divisionsPerQuarter;
    }

    /**
     * Ger part ab
     *
     * @param array $part The part metadata array.
     * @return string
     */
    private function getPartAbbreviation($part)
    {
        return isset($part) && isset($part['instrument']) && isset($part['instrument'][1]) ? $part['instrument'][1] : $part['instrument'][0];
    }

    /**
     * Get part volume
     *
     * @param string $partId The MusicXML part ID.
     * @return integer
     */
    private function getPartVolume($partId)
    {
        return isset($this->partVolume[$partId]) ? $this->partVolume[$partId] : 0;
    }

    /**
     * Get part pan
     *
     * @param string $partId The MusicXML part ID.
     * @return integer
     */
    private function getPartPan($partId)
    {
        return isset($this->partPan[$partId]) ? $this->partPan[$partId] : 0;
    }

    /**
     * Check if note is audible or not
     *
     * @param array $message The note event message array.
     * @param integer $duration The calculated duration of the note in ticks.
     * @return boolean
     */
    private function isAudible($message, $duration)
    {
        return $duration > 0 && $message['event'] == 'On' && $message['value'] > 0 && $message['note'] > 13;
    }

    /**
     * Converts a MidiMeasure object into a MusicXML score-partwise DOM structure.
     * This is the core conversion logic that builds the entire MusicXML hierarchy
     * from the parsed MIDI data.
     *
     * @param MidiMeasure $midi The parsed MIDI data object.
     * @param string $title The title of the work.
     * @param DOMDocument $domdoc The parent DOMDocument to which the new nodes will be appended.
     * @param string $version The MusicXML version string to set in the score-partwise element.
     * @return DOMNode The root DOMNode of the generated score-partwise element.
     */
    public function convertMidiToMusicXML($midi, $title, $domdoc, $version = "4.0")
    {

        $this->resetProperties();
        $timebase = $midi->getTimebase();
        $scorePartwise = new ScorePartwise();
        $scorePartwise->version = $version;
        $scorePartwise->identification = $this->getIdentification($this->copyright);
        $scorePartwise->work = MusicXMLUtil::getWork($title);
        $scorePartwise->partList = new PartList();
        $scorePartwise->partList->partGroup = array();

        $this->buildPartList($midi);
        $this->buildTimeDivisions($timebase);
        if (isset($this->copyright)) {
            $scorePartwise->identification->rights = array(new Rights($this->copyright));
        }
        
        // sort part list by channelId and programId
        $channelIdX  = array_column($this->partList, 'channelId');
        $programIdX = array_column($this->partList, 'programId');
        array_multisort($channelIdX, SORT_ASC, $programIdX, SORT_ASC, $this->partList);

        // begin part list
        $partIndex = 1;

        $scorePartwise->partList->scorePart = array();

        $this->divisionsPerQuarter = self::DEFAULT_DIVISONS; // Use a smaller, standard divisions value for cleaner rhythm.

        foreach ($this->partList as $part) {
            // start add score part
            // this block will be iterated each channel

            $partId = $part['partId'];
            $channelId = $part['channelId'];
            $partName = $part['instrument'][0];
            $partAbbreviation = $this->getPartAbbreviation($part);
            $instrumentName = $part['instrument'][0];
            $programId = $part['programId'];

            if ($channelId == 10) {
                $scorePartwise->partList->scorePart[] = $this->getScorePartChannel10($partId, $channelId, $programId, $partName, $partAbbreviation);
            } else {
                if (isset(MusicXMLInstrument::INSTRUMENT_LIST[$programId - 1]) && isset(MusicXMLInstrument::INSTRUMENT_LIST[$programId - 1][2])) {
                    $instrumentSound = MusicXMLInstrument::INSTRUMENT_LIST[$programId - 1][2];
                } else {
                    $this->getInstrumentSound($channelId, $programId, $instrumentName);
                    $instrumentSound = strtolower(str_replace(' ', '.', $part['instrument'][0]));
                }
                $midiChannel = $part['channelId'];
                $midiProgramId = $part['programId'];
                $instrumentId = $part['instrumentId'];
                $min = isset($this->channelNoteMin[$channelId]) ? $this->channelNoteMin[$channelId] : 60;
                $max = isset($this->channelNoteMax[$channelId]) ? $this->channelNoteMax[$channelId] : 72;
                $this->clefs[$channelId] = MusicXMLUtil::getClef($min, $max);
                $volumeRaw = $this->getPartVolume($partId);
                $volume = $volumeRaw * 100 / (0.9 * 127);

                // 4 place decimal
                $volume = round($volume, 4);
                $panRaw = $this->getPartPan($partId);
                $pan = ($panRaw - 64) * 90 / 64;
                $scoreInstrument = $this->getScoreInstrument($instrumentId, $instrumentName, $instrumentSound);
                $midiInstrument = $this->getMidiInstrument($midiChannel, $instrumentId, $midiProgramId, $volume, $pan);
                $midiDevice = $this->getMidiDevice($instrumentId, $midiChannel);
                $scorePartwise->partList->scorePart[] = $this->getScorePart($partId, $partName, $partAbbreviation, $scoreInstrument, $midiInstrument, $midiDevice);
            }

            if ($channelId == 10) {
                $percussionClef = new Clef(array('sign' => new Sign('percussion')));
                $this->clefs[$channelId] = array($percussionClef);
            } else {
                $min = isset($this->channelNoteMin[$channelId]) ? $this->channelNoteMin[$channelId] : 60;
                $max = isset($this->channelNoteMax[$channelId]) ? $this->channelNoteMax[$channelId] : 72;
                $this->clefs[$channelId] = MusicXMLUtil::getClef($min, $max);
            }
            
            // end add score part
            $partIndex++;
        }
        // end part list

        $scorePartwise->part = array();



        $totalMeasure = $this->maxMeasure + 1;
        if($totalMeasure == 0)
        {
            $totalMeasure = 1;
        }

        // begin part

        // Determine which channel should hold the lyrics
        $lyricChannelId = -1;
        $allPartChannels = array_column($this->partList, 'channelId');
        if (in_array(4, $allPartChannels)) {
            $lyricChannelId = 4;
        } elseif (!empty($allPartChannels)) {
            $lyricChannelId = $allPartChannels[0];
        }

        foreach ($this->partList as $part) {
            $partId = $part['partId'];
            $channelId = $part['channelId'];
            
            // Clear tie continuation for the specific part before processing
            unset($this->tieContinue[$channelId]);

            $part = new PartPartwise();
            $part->id = $partId;
            $part->measure = array();
            for ($measureIndex = 0; $measureIndex < $totalMeasure; $measureIndex++) {
                $measure = $this->getMeasure($partId, $channelId, $measureIndex, $timebase, $lyricChannelId);
                $part->measure[] = $measure;
            }
            $scorePartwise->part[] = $part;
        }
        // end part

        return $scorePartwise->toXml($domdoc, self::SCORE_PARTWISE);
    }

    /**
     * Get score part channel 10
     *
     * @param string $partId The MusicXML part ID (e.g., "P10").
     * @param integer $channelId The MIDI channel ID (should be 10).
     * @param integer $programId The MIDI program ID for the drum kit.
     * @param string $partName The display name for the part (e.g., "Drums").
     * @param string $partAbbreviation The abbreviated name (e.g., "Drs.").
     * @return ScorePart
     */
    private function getScorePartChannel10($partId, $channelId, $programId, $partName, $partAbbreviation)
    {
        $scorePart = new ScorePart();
        $scorePart->id = $partId;
        $scorePart->scoreInstrument = array();
        $scorePart->midiInstrument = array();

        $midiDevice = new MidiDevice();
        $midiDevice->port = 1; // Always route drum kit to Port 1 for unified synthesizer compatibility
        $scorePart->midiDevice = array($midiDevice);

        $scorePart->partName = new PartName($partName);
        $scorePart->partAbbreviation = new PartAbbreviation($partAbbreviation);
        
        foreach (MusicXMLInstrument::DRUM_SET as $midiCode => $drumDetails)
        {
            $scoreInstrument = new ScoreInstrument();
            $midiInstrument = new MidiInstrument();
            $key = $midiCode + 1;
            $id = $partId . '-I' . $key;
            $scoreInstrument->id = $id;
            $scoreInstrument->instrumentName = new InstrumentName($drumDetails[0]);
            
            if (isset($drumDetails[2]) && !empty($drumDetails[2])) {
                $scoreInstrument->instrumentSound = new InstrumentSound($drumDetails[2]);
            }
            
            $midiInstrument->id = $id;
            $midiInstrument->midiChannel = new MidiChannel($channelId);
            $midiInstrument->midiProgram = new MidiProgram($programId);
            $midiInstrument->midiUnpitched = new MidiUnpitched($midiCode + 1);
            
            $volume = 80.0;
            if (isset($this->channel10[$key])) {
                $val = $this->channel10[$key];
                $volume = isset($val['v']) ? round($val['v'] * 100 / 127, 2) : 80.0;
            }
            if($volume > 100)
            {
                $volume = 100;
            }
            $midiInstrument->volume = new Volume($volume);
            $scorePart->scoreInstrument[] = $scoreInstrument;
            $scorePart->midiInstrument[] = $midiInstrument;
        }
        return $scorePart;
    }

    /**
     * Check that measure has message or not
     *
     * @param integer $channelId The MIDI channel ID.
     * @param integer $measureIndex The index of the measure to check.
     * @return boolean
     */
    private function hasMessage($channelId, $measureIndex)
    {
        return isset($this->measures[$channelId]) && isset($this->measures[$channelId][$measureIndex]);
    }

    /**
     * Get MIDI Events
     *
     * @param array $controlEvents An array of MIDI control event messages for a measure.
     * @return MidiEvent
     */
    private function getEventList($controlEvents)
    {
        $tempoList = array();
        $keySignatureList = array();
        foreach ($controlEvents as $message)
        {
            $time = $message['time'];
            if($message['event'] == 'Tempo')
            {
                $tempoList[$time] = array('rawtime' => $message['rawtime'], 'tempo' => $message['value'], 'bpm' => round((60000000 / $message['value'])));
            }
            if($message['event'] == 'KeySig')
            {
                $fifths = isset($message['fifths']) ? (int)$message['fifths'] : 0;
                $keySignatureList[$time] = array('fifths' => $fifths, 'mode' => $message['mode']);
            }
        }
        return new MidiEvent($tempoList, $keySignatureList);
    }

    /**
     * Build measure divisions
     *
     * @param integer $timebase The MIDI file's timebase (ticks per quarter note).
     * @return void
     */
    private function buildTimeDivisions($timebase)
    {
        $measureLength = $this->timeSignature->getBeats() * $timebase;
        $this->measureOnsets = array();
        $allOnsets = array();
        $notes = array();

        foreach($this->partList as $part)
        {
            $ch = $part['channelId'];
            if (!isset($this->measures[$ch])) continue;
            foreach($this->measures[$ch] as $measureIndex => $events)
            {
                foreach($events as $event)
                {
                    if($event['event'] == 'On' || $event['event'] == 'Off')
                    {
                        $mIdx = (int)$measureIndex;
                        if(!isset($allOnsets[$mIdx])) $allOnsets[$mIdx] = array();
                        $allOnsets[$mIdx][$event['abstime']] = true;
                        
                        if($event['event'] == 'On') {
                            if(!isset($notes[$mIdx])) $notes[$mIdx] = array();
                            $notes[$mIdx][] = $event;
                        }
                    }
                }
            }
        }

        for($i = 0; $i <= $this->maxMeasure; $i++)
        {
            $this->setMeasureDivisions($i, $timebase);
            if(isset($notes[$i])) {
                $measureDivison = new MeasureDivision($timebase, $notes[$i]);
                $this->setMeasureDivisions($i, $measureDivison->getDivision());
            }

            if (isset($allOnsets[$i])) {
                ksort($allOnsets[$i]);
                $currentX = 60; // Padding kiri birama
                $this->measureOnsets[$i] = array();
                
                foreach ($allOnsets[$i] as $abstime => $val) {
                    $this->measureOnsets[$i][$abstime] = $currentX;
                    
                    // Cari lirik terpanjang pada titik waktu ini
                    $maxLen = 0;
                    foreach ($this->lyrics as $chLyrics) {
                        if (isset($chLyrics[$abstime])) $maxLen = max($maxLen, mb_strlen($chLyrics[$abstime]));
                    }
                    // Porsi minimal per nada adalah 60 tenths, atau disesuaikan lirik (karakter * 14)
                    $currentX += max(60, $maxLen * 14.0);
                }
                // Set lebar birama total agar tidak memotong nada terakhir
                $this->measureWidth[$i] = $currentX + 60;
            }
        }
    }

    /**
     * Fix duration
     *
     * @param integer $rawDuration The duration in MIDI ticks.
     * @param integer $divisions The number of divisions per quarter note for the score.
     * @param integer $timebase The MIDI file's timebase (ticks per quarter note).
     * @return integer
     */
    public function fixDuration($rawDuration, $divisions, $timebase)
    {
        if ($timebase <= 0) {
            return 0;
        }
        // Quantize the raw MIDI ticks first for better rhythmic alignment
        $quantizedTicks = $this->quantize($rawDuration, $timebase);
        $xmlDuration = (int) round($quantizedTicks * $divisions / $timebase);
        // Ensure that a note with a very short but non-zero duration gets at least 1 division
        return ($xmlDuration == 0 && $quantizedTicks > 0) ? 1 : $xmlDuration;
    }

    /**
     * Set measure divison
     *
     * @param integer $measureIndex The index of the measure.
     * @param float $divisions The proposed divisions value.
     * @return void
     */
    private function setMeasureDivisions($measureIndex, $divisions)
    {
        if(!isset($this->measureDivisions[$measureIndex]) || $this->measureDivisions[$measureIndex] < $divisions)
        {
            $this->measureDivisions[$measureIndex] = $divisions;
            $width = $divisions * $this->widthScale;
            if($width < $this->minWidth)
            {
                $width = $this->minWidth;
            }
            $this->measureWidth[$measureIndex] = $width;
        }
    }

    /**
     * Get measure
     *
     * @param string $partId The MusicXML part ID.
     * @param integer $channelId The MIDI channel ID.
     * @param integer $measureIndex The index of the measure to build.
     * @param integer $timebase The MIDI file's timebase.
     * @param integer $lyricChannelId The channel ID designated to carry the main lyrics.
     * @return MeasurePartwise
     */
    private function getMeasure($partId, $channelId, $measureIndex, $timebase, $lyricChannelId)
    {
        $measure = new MeasurePartwise();
        $attributes = new Attributes();
        $hasAttributes = false;
        $divisions = $this->divisionsPerQuarter;

        // Divisions adalah detak per quarter note. Wajib ada di Attributes.
        $attributes->divisions = new Divisions($divisions);

        $measure->number = $measureIndex + 1;
        if (isset($this->measureWidth[$measureIndex])) {
            $measure->width = $this->measureWidth[$measureIndex];
        }

        // Birama pertama WAJIB memiliki atribut dasar (Divisions, Time, Clef)
        if ($measureIndex == 0) {
            $attributes->divisions = new Divisions($divisions);
            $attributes->time = $this->getTime($this->timeSignature);
            
            if (isset($this->clefs[$channelId])) {
                $attributes->clef = $this->clefs[$channelId];
            } else {
                $attributes->clef = MusicXMLUtil::getClef(60, 72); // Default Treble
            }

            if (isset($this->clefs[$channelId]) && count($this->clefs[$channelId]) > 1) {
                $attributes->staves = new Staves(count($this->clefs[$channelId]));
            }
            $hasAttributes = true;
        }

        // Ambil event global (Tempo, KeySig) dari channel 0
        if ($this->hasMessage(0, $measureIndex)) {
            $midiEventMessages = $this->measures[0][$measureIndex];
            $controlEvents0 = MusicXMLUtil::getControlEvent($midiEventMessages);
            $midiEvent = $this->getEventList($controlEvents0);
            $tempoList = $midiEvent->getTempoList();
            $keySignatureList = $midiEvent->getKeySignatureList();

            if(!empty($tempoList)) {
                $directions = MusicXMLUtil::getDirections($tempoList);
            }
            // Pastikan Key Signature hanya ditambahkan jika bukan track perkusi
            if(!empty($keySignatureList) && $channelId != 10) {
                // Ambil hanya Key Signature terakhir dalam birama ini untuk mencegah elemen ganda
                $lastKS = end($keySignatureList);
                $attributes->key = array($this->getKey($lastKS['fifths'], $lastKS['mode']));
                $hasAttributes = true;
            }
        }
        
        if ($hasAttributes) {
            $measure->elements[] = $attributes;
        }

        // add attribute

        // add directions
        if(!empty($directions)) {
            foreach($directions as $direction)
            {
                $measure->elements[] = $direction;
            }
        }

        // Selalu proses elemen birama untuk memastikan durasi birama terisi dengan nada atau tanda istirahat,
        // dan untuk menangani lirik meskipun tidak ada nada yang terdengar di birama ini untuk channel tersebut.
        $midiEventMessages = $this->hasMessage($channelId, $measureIndex) ? $this->measures[$channelId][$measureIndex] : array();
        $noteMessages = MusicXMLUtil::getNotes($midiEventMessages);
        
        // Urutkan pesan nada berdasarkan waktu absolut untuk deteksi chord dan pemrosesan sekuensial
        usort($noteMessages, function($a, $b) {
            if ($a['abstime'] == $b['abstime']) return 0;
            return ($a['abstime'] < $b['abstime']) ? -1 : 1;
        });

        $measureContainer = $this->addMeasureElement($measureIndex, $measure, $noteMessages, $partId, $channelId, $divisions, $timebase, $lyricChannelId);
        $measure = $measureContainer->getMeasurePartwise();
        $noteMessages = $measureContainer->getNoteMessages();

        if ($this->hasMessage($channelId, $measureIndex)) {
            $controlEvents = MusicXMLUtil::getControlEvent($midiEventMessages);
            if (!empty($controlEvents)) {
                $pbIndexes = array();
                foreach ($controlEvents as $message) //NOSONAR
                {
                    if($message['event'] == 'Pb')
                    {
                        $idx = MusicXMLUtil::getNoteIndex($noteMessages, $message['time'], $timebase);
                        if($idx !== false)
                        {
                            $pbIndexes[] = array($idx, $message['value']);
                        }
                    }
                }

                // pre bend

                foreach($pbIndexes as $idx=>$pitchBend)
                {
                    $elementIndex = MusicXMLUtil::getElementIndexFromNoteIndex($noteMessages);
                    if($elementIndex !== false
                        && $measure->elements[$elementIndex] instanceof Note
                        && isset($measure->elements[$elementIndex]->notations)
                        && is_array(isset($measure->elements[$elementIndex]->notations))
                        && !empty(isset($measure->elements[$elementIndex]->notations)))
                    {
                        $bend = $this->getBend($pitchBend[0]);
                        $technical = new Technical();
                        $technical->bend = array($bend);
                        if(!isset($measure->elements[$elementIndex]->notations[0]->technical))
                        {
                            $measure->elements[$elementIndex]->notations[0]->technical = array($technical);
                        }
                        else
                        {
                            $measure->elements[$elementIndex]->notations[0]->technical[0] = $technical;
                        }
                    }
                }
            }

            // set beam if any
            $beams = MusicXMLUtil::getBeams($noteMessages, $timebase, $this->timeSignature);
            if($beams !== false)
            {
                foreach($beams as $beamNote)
                {
                    if($measure->elements[$beamNote->index] instanceof Note)
                    {
                        $measure->elements[$beamNote->index]->beam = $beamNote->beam;
                    }
                }
            }
        }

        return $measure;
    }

    /**
     * Mendapatkan lirik untuk birama dan channel saat ini
     * @param int $measureIndex The index of the current measure.
     * @param int $measureLength The length of the measure in MIDI ticks.
     * @param int $channelId The current channel being processed.
     * @param int $lyricChannelId The channel designated to hold lyrics.
     * @return array Map dari abstime => text
     */
    private function getLyricsForMeasure($measureIndex, $measureLength, $channelId, $lyricChannelId)
    {
        $lyricsInRange = array();
        if ($channelId == $lyricChannelId) {
            $measureStart = $measureIndex * $measureLength;
            $measureEnd = $measureStart + $measureLength;
            
            $sources = array();
            if (isset($this->lyrics[$channelId])) $sources[] = $this->lyrics[$channelId];
            if (isset($this->lyrics[0])) $sources[] = $this->lyrics[0];
            
            foreach ($sources as $source) {
                foreach ($source as $abs => $txt) {
                    if ($abs >= $measureStart && $abs < $measureEnd) {
                        $lyricsInRange[$abs] = $txt;
                    }
                }
            }
        }
        return $lyricsInRange;
    }

    /**
     * Membuat objek model Lyric
     * @param string $text The lyric text.
     * @return Lyric
     */
    private function createLyricModel($text)
    {
        $lyric = new Lyric();
        $lyric->text = array(new TextElement($text));
        $lyric->justify = 'center';
        return $lyric;
    }


    /**
     * Add element to measure
     *
     * @param integer $measureIndex The index of the measure being built.
     * @param MeasurePartwise $measure The measure object to populate.
     * @param array $noteMessages An array of sorted note events for this measure.
     * @param string $partId The MusicXML part ID.
     * @param integer $channelId The MIDI channel ID.
     * @param integer $divisions The divisions per quarter note.
     * @param integer $timebase The MIDI file's timebase.
     * @param integer $lyricChannelId The channel ID designated for lyrics.
     * @return MeasurePartwiseContainer
     */
    private function addMeasureElement($measureIndex, $measure, $noteMessages, $partId, $channelId, $divisions, $timebase, $lyricChannelId)
    {
        $measureLengthTicks = $timebase * $this->timeSignature->getBeats();
        $xmlMeasureLength = $divisions * $this->timeSignature->getBeats();
        $xmlCursor = 0;
        $prevAbstime = -1;
        
        $absMeasureStart = $measureIndex * $measureLengthTicks;
        // Identifikasi lirik yang akan diproses untuk channel dan birama ini
        $lyricCarrier = $this->getLyricsForMeasure($measureIndex, $measureLengthTicks, $channelId, $lyricChannelId);

        $lyricDivisions = array();
        foreach ($lyricCarrier as $abs => $txt) {
            $xmlPos = (int) round(($abs - $absMeasureStart) * $divisions / $timebase);
            if (!isset($lyricDivisions[$xmlPos])) {
                $lyricDivisions[$xmlPos] = $txt;
            } else {
                $lyricDivisions[$xmlPos] .= ' ' . $txt;
            }
        }

        // Check if there is a continued tie from the previous measure for this part
        if (isset($this->tieContinue[$channelId]) && !empty($this->tieContinue[$channelId])) {
            $firstTie = true;
            foreach ($this->tieContinue[$channelId] as $noteCode => $tieInfo) {
                $remainingDuration = $tieInfo['duration'];
                $continueDuration = min($remainingDuration, $measureLengthTicks);

                $xmlEnd = (int) round($continueDuration * $divisions / $timebase);
                $xmlDuration = $xmlEnd; // Starts at 0
                if ($xmlDuration <= 0 && $continueDuration > 0) $xmlDuration = 1; // Ensure minimum duration

                $note = new Note();
                if (isset($tieInfo['dynamics'])) {
                    $note->dynamics = $tieInfo['dynamics'];
                }
                $voice = new \MusicXML\Model\Voice();
                $voice->textContent = '1';
                $note->voice = $voice;

                if ($channelId == 10) {
                    $note->unpitched = new Unpitched();
                    $visuals = $this->getDrumVisuals($noteCode);
                    $note->unpitched->displayStep = new DisplayStep($visuals['step']);
                    $note->unpitched->displayOctave = new DisplayOctave($visuals['octave']);
                    if ($visuals['notehead'] !== 'normal') {
                        $note->notehead = new \MusicXML\Model\Notehead();
                        $note->notehead->textContent = $visuals['notehead'];
                    }
                    $stem = new \MusicXML\Model\Stem();
                    $stem->textContent = $visuals['stem'];
                    $note->stem = $stem;
                    $note->instrument = new \MusicXML\Model\Instrument(array('id' => $partId . '-I' . ($noteCode + 1)));
                } else {
                    $note->pitch = $this->getPitch($noteCode);
                    $stem = new \MusicXML\Model\Stem();
                    $stem->textContent = 'up';
                    $note->stem = $stem;
                }
                $note->notations = array($this->getNotation());
                
                $absTime = $measureIndex * $measureLengthTicks;
                if (!$firstTie) {
                    $note->chord = new Chord();
                } else {
                    // Lampirkan lirik jika ada di awal birama untuk nada pertama dari grup tie
                    if (isset($lyricDivisions[0])) {
                        $note->lyric = array($this->createLyricModel($lyricDivisions[0]));
                        unset($lyricDivisions[0]);
                    }
                }

                if ($remainingDuration <= $measureLengthTicks) {
                    $note->notations[0]->tied = array(new Tied(array('type'=>'stop')));
                    $note->tie = new Tie(array('type'=>'stop'));
                } else {
                    $note->notations[0]->tied = array(
                        new Tied(array('type'=>'stop')),
                        new Tied(array('type'=>'start'))
                    );
                    $note->tie = array(
                        new Tie(array('type'=>'stop')),
                        new Tie(array('type'=>'start'))
                    );
                }

                $note->duration = new Duration($xmlDuration);
                $note->type = new Type(MusicXMLUtil::getNoteType($xmlDuration, $divisions));
                $dotsCount = MusicXMLUtil::getNoteDots($xmlDuration, $divisions);
                if ($dotsCount > 0) {
                    $note->dot = array_fill(0, $dotsCount, new \MusicXML\Model\Dot());
                }
                
                if (isset($this->measureOnsets[$measureIndex][$absTime])) {
                    $note->defaultX = $this->measureOnsets[$measureIndex][$absTime];
                }

                $measure->elements[] = $note;
                if ($firstTie) $xmlCursor += $xmlDuration;
                $prevAbstime = $measureIndex * $measureLengthTicks;

                if ($remainingDuration > $measureLengthTicks) {
                    $this->tieContinue[$channelId][$noteCode]['duration'] -= $measureLengthTicks;
                } else {
                    unset($this->tieContinue[$channelId][$noteCode]);
                }
                $firstTie = false;
            }
        }


        // before add current note, if this measure has tie stop, create it first
        if(isset($this->tieStop[$measureIndex]))
        {
            foreach($this->tieStop[$measureIndex] as $tieStop)
            {
                // add tie note
                $measure->elements[] = $tieStop->getNote();
            }
        }

        foreach ($noteMessages as $idx => $message) {
            $duration = isset($message['duration']) ? $message['duration'] : 0;
            $duration = $this->quantize($duration, $timebase); // Quantize duration
            
            if ($this->isAudible($message, $duration)) {
                
                $offsetTicks = $message['abstime'] % $measureLengthTicks;
                $xmlStart = (int) round($offsetTicks * $divisions / $timebase);
                $isChord = ($idx > 0 && $message['abstime'] == $prevAbstime); // A chord is notes starting at the exact same time.

                if (!$isChord && $xmlStart > $xmlCursor) {
                    // Isi celah dengan tanda istirahat, pecah jika ada lirik di antaranya
                    $this->fillGapWithRests($measure, $measureIndex, $divisions, $timebase, $xmlCursor, $xmlStart, $lyricDivisions);
                    $xmlCursor = $xmlStart;
                }

                $note = $this->createSoundNote($measureIndex, $partId, $channelId, $message, $divisions, $timebase, $duration);

                // Atur koordinat X eksplisit
                if (isset($this->measureOnsets[$measureIndex][$message['abstime']])) {
                    $note->defaultX = $this->measureOnsets[$measureIndex][$message['abstime']];
                }

                if ($isChord) {
                    $note->chord = new Chord();
                }

                $localEndTicks = $offsetTicks + $duration; // End position of the note within the measure's tick-based timeline
                if ($localEndTicks > $measureLengthTicks) {
                    $durationInMeasure = $measureLengthTicks - $offsetTicks;
                    $remainingDuration = $duration - $durationInMeasure;
                    $note = $this->trimNoteDuration($note, $durationInMeasure, $divisions, $timebase); // Trim and add 'start' tie
                    $xmlDuration = $note->duration->textContent;
                    
                    $this->tieContinue[$channelId][$message['note']] = array(
                        'duration' => $remainingDuration,
                        'dynamics' => $note->dynamics
                    );
                } else {
                    $xmlDuration = $note->duration->textContent;
                }

                // Lampirkan lirik jika ada di awal nada suara ini
                // Perbaikan: Gabungkan semua lirik yang berada dalam rentang durasi nada ini
                if (!$isChord) {
                    $noteXmlEnd = $xmlStart + $xmlDuration;
                    $lyricsForThisNote = array();
                    foreach ($lyricDivisions as $xmlPos => $txt) {
                        if ($xmlPos >= $xmlStart && $xmlPos < $noteXmlEnd) {
                            $lyricsForThisNote[] = $txt;
                            unset($lyricDivisions[$xmlPos]);
                        }
                    }
                    if (!empty($lyricsForThisNote)) {
                        $note->lyric = array($this->createLyricModel(implode(' ', $lyricsForThisNote)));
                    }
                }

                $measure->elements[] = $note;
                if (!$isChord) {
                    $xmlCursor = $xmlStart + $xmlDuration;
                }
                $prevAbstime = $message['abstime']; // Update prevAbstime for chord detection
                $noteMessages[$idx]['elementIndex'] = count($measure->elements) - 1;
            }
        }

        // add rest to fill the measure, if needed
        if ($xmlCursor < $xmlMeasureLength) {
            $this->fillGapWithRests($measure, $measureIndex, $divisions, $timebase, $xmlCursor, $xmlMeasureLength, $lyricDivisions);
        }

        return new MeasurePartwiseContainer($measure, $noteMessages);
    }

    /**
     * Mengisi celah dalam birama dengan tanda istirahat, memecahnya jika terdapat lirik.
     *
     * @param MeasurePartwise $measure The measure object to add rests to.
     * @param int $measureIndex The index of the current measure.
     * @param int $divisions The divisions per quarter note.
     * @param int $timebase The MIDI file's timebase.
     * @param int $xmlStart The starting position of the gap in XML divisions.
     * @param int $xmlEnd The ending position of the gap in XML divisions.
     * @param array &$lyricDivisions A reference to the remaining lyrics map for the measure.
     */
    private function fillGapWithRests($measure, $measureIndex, $divisions, $timebase, $xmlStart, $xmlEnd, &$lyricDivisions)
    {
        if ($xmlEnd <= $xmlStart) return; // No gap to fill
        $measureLength = $timebase * $this->timeSignature->getBeats();
        $absMeasureStart = $measureIndex * $measureLength;
        
        // Identifikasi batas-batas di dalam celah ini berdasarkan posisi lirik
        $boundaries = array($xmlEnd); 
        $lyricsAt = array();
        foreach ($lyricDivisions as $xmlPos => $txt) {
            if ($xmlPos >= $xmlStart && $xmlPos < $xmlEnd) {
                $boundaries[] = $xmlPos;
                $lyricsAt[$xmlPos] = $txt;
                unset($lyricDivisions[$xmlPos]); // Konsumsi lirik
            }
        }
        $boundaries = array_unique($boundaries);
        sort($boundaries);

        $currentXml = $xmlStart;
        foreach ($boundaries as $nextXml) {
            $dur = $nextXml - $currentXml;
            if ($dur > 0) { // Only add rest if there is a duration
                $rest = $this->createRestNote($measureIndex, array(), $divisions, $timebase, 0, $currentXml == 0);
                $rest->duration = new Duration($dur);
                $rest->type = new Type(MusicXMLUtil::getNoteType($dur, $divisions));
                $dotsCount = MusicXMLUtil::getNoteDots($dur, $divisions);
                if ($dotsCount > 0) {
                    $rest->dot = array_fill(0, $dotsCount, new \MusicXML\Model\Dot());
                }
                
                $absTime = $absMeasureStart + (int)round($currentXml * $timebase / $divisions);
                if (isset($this->measureOnsets[$measureIndex][$absTime])) {
                    $rest->defaultX = $this->measureOnsets[$measureIndex][$absTime];
                }
                if (isset($lyricsAt[$currentXml])) {
                    $rest->lyric = array($this->createLyricModel($lyricsAt[$currentXml]));
                }
                $measure->elements[] = $rest;
                $currentXml = $nextXml;
            }
        }
    }

    /**
     * Trim note duration
     * Split note when it exceeds measure boundary, applying tie notation
     *
     * @param Note $note The note object to modify.
     * @param integer $newRawDuration The new duration for the note within the current measure, in MIDI ticks.
     * @param integer $divisions The divisions per quarter note.
     * @param integer $timebase The MIDI file's timebase.
     * @return Note
     */
    private function trimNoteDuration($note, $newRawDuration, $divisions, $timebase)
    {
        if ($newRawDuration > 0) {
            $musicXMLDuration = $this->fixDuration($newRawDuration, $divisions, $timebase);
            if ($musicXMLDuration == 0 && $newRawDuration > 0) {
                $musicXMLDuration = 1; // Smallest possible duration
            }
            $note->duration = new Duration($musicXMLDuration);
            $note->type = new Type(MusicXMLUtil::getNoteType($musicXMLDuration, $divisions));
            $dotsCount = MusicXMLUtil::getNoteDots($musicXMLDuration, $divisions);
            if ($dotsCount > 0) {
                $note->dot = array_fill(0, $dotsCount, new \MusicXML\Model\Dot());
            } else {
                unset($note->dot);
            }
            $tie = new Tie(); // Create a new Tie object
            $tie->type = 'start'; // Set type to 'start'
            $tied = new Tied();
            $tied->type = 'start';
            $note->tie = $tie;
            $note->notations[0]->tied = array($tied);
        }
        return $note;
    }

    /**
     * Create rest note
     *
     * @param integer $measureIndex The index of the current measure.
     * @param array $message The (often empty) message array.
     * @param integer $divisions The divisions per quarter note.
     * @param integer $timebase The MIDI file's timebase.
     * @param integer $duration The duration of the rest in MIDI ticks.
     * @param boolean $begining (Unused) Was intended to mark if the rest is at the start of a measure.
     * @return Note
     */
    private function createRestNote($measureIndex, $message, $divisions, $timebase, $duration, $begining = false)
    {
        $note = new Note();
        $rest = new Rest();
        $note->rest = $rest;
        
        $voice = new \MusicXML\Model\Voice();
        $voice->textContent = '1';
        $note->voice = $voice;

        $rawDuration = $duration;
        $duration = $this->fixDuration($rawDuration, $divisions, $timebase);
        if ($duration <= 0 && $rawDuration > 0) {
            $duration = 1;
        }
        $note->duration = new Duration($duration);
        $note->type = new Type(MusicXMLUtil::getNoteType($duration, $divisions));
        $dotsCount = MusicXMLUtil::getNoteDots($duration, $divisions);
        if ($dotsCount > 0) {
            $note->dot = array_fill(0, $dotsCount, new \MusicXML\Model\Dot());
        }
        return $note;
    }

    /**
     * Get drum visual mapping (step, octave, notehead, stem).
     * @param int $noteCode The MIDI note number for the drum sound.
     * @return array An associative array with 'step', 'octave', 'notehead', and 'stem'.
     */
    private function getDrumVisuals($noteCode)
    {
        $step = 'G';
        $octave = 5;
        $notehead = 'normal';
        $stem = 'up';
        
        switch ($noteCode) {
            // Kicks
            case 35:
            case 36:
                $step = 'F';
                $octave = 4;
                $notehead = 'normal';
                $stem = 'down';
                break;
            // Side stick
            case 37:
                $step = 'C';
                $octave = 5;
                $notehead = 'x';
                $stem = 'up';
                break;
            // Snares
            case 38:
                $step = 'C';
                $octave = 5;
                $notehead = 'normal';
                $stem = 'up';
                break;
            case 40:
                $step = 'C';
                $octave = 5;
                $notehead = 'slash';
                $stem = 'up';
                break;
            // Hand clap
            case 39:
                $step = 'A';
                $octave = 5;
                $notehead = 'x';
                $stem = 'up';
                break;
            // Floor Toms
            case 41:
            case 43:
                $step = 'A';
                $octave = 4;
                $notehead = 'normal';
                $stem = 'up';
                break;
            // Hi-Hats
            case 42: // Closed Hi-Hat
            case 46: // Open Hi-Hat
                $step = 'G';
                $octave = 5;
                $notehead = 'x';
                $stem = 'up';
                break;
            case 44: // Pedal Hi-Hat
                $step = 'D';
                $octave = 4;
                $notehead = 'x';
                $stem = 'down';
                break;
            // Toms
            case 45: // Low Tom
            case 47: // Low-Mid Tom
                $step = 'D';
                $octave = 5;
                $notehead = 'normal';
                $stem = 'up';
                break;
            case 48: // Hi-Mid Tom
            case 50: // High Tom
                $step = 'E';
                $octave = 5;
                $notehead = 'normal';
                $stem = 'up';
                break;
            // Cymbals
            case 49: // Crash 1
            case 57: // Crash 2
                $step = 'A';
                $octave = 5;
                $notehead = 'x';
                $stem = 'up';
                break;
            case 51: // Ride 1
            case 59: // Ride 2
                $step = 'F';
                $octave = 5;
                $notehead = 'x';
                $stem = 'up';
                break;
            case 55: // Splash Cymbal
                $step = 'G';
                $octave = 5;
                $notehead = 'x';
                $stem = 'up';
                break;
            default:
                // Fallback to standard G5 with x notehead for other percussion
                $step = 'G';
                $octave = 5;
                $notehead = 'x';
                $stem = 'up';
                break;
        }
        
        return array(
            'step' => $step,
            'octave' => $octave,
            'notehead' => $notehead,
            'stem' => $stem
        );
    }

    /**
     * Creates a MusicXML <note> element for a pitched or unpitched sound.
     *
     * This includes setting the pitch/unpitched properties, duration, type, stem,
     * dynamics (based on velocity, volume, and expression), and instrument mapping for percussion.
     *
     * @param integer $measureIndex The index of the current measure.
     * @param string $partId The MusicXML part ID (e.g., 'P1').
     * @param integer $channelId The MIDI channel ID (0-15).
     * @param array $message The note 'On' event message array, containing details like note number and velocity.
     * @param integer $divisions The number of divisions per quarter note for the score.
     * @param integer $timebase The MIDI file's timebase (ticks per quarter note).
     * @param integer $originalDuration The original duration of the note in MIDI ticks.
     * @return Note The fully constructed Note object, ready to be added to a measure.
     */
    private function createSoundNote($measureIndex, $partId, $channelId, $message, $divisions, $timebase, $originalDuration)
    {
        $noteCode = $message['note'];
        $note = new Note();
        
        $voice = new \MusicXML\Model\Voice();
        $voice->textContent = '1';
        $note->voice = $voice;

        // Apply CC Volume and CC Expression dynamics scaling formula
        $velocity = isset($message['value']) ? $message['value'] : 64;
        $tick = isset($message['abstime']) ? $message['abstime'] : 0;
        $volume = $this->getVolume($channelId, $tick);
        $expression = $this->getExpression($channelId, $tick);
        
        $v = ($velocity / 127.0) * ($volume / 127.0) * ($expression / 127.0) * 100.0;
        $note->dynamics = round($v, 2);

        if ($channelId == 10) { // Percussion handling
            $note->unpitched = new Unpitched();
            $visuals = $this->getDrumVisuals($noteCode);
            
            $note->unpitched->displayStep = new DisplayStep($visuals['step']);
            $note->unpitched->displayOctave = new DisplayOctave($visuals['octave']);
            if ($visuals['notehead'] !== 'normal') {
                $note->notehead = new \MusicXML\Model\Notehead();
                $note->notehead->textContent = $visuals['notehead'];
            }
            $stem = new \MusicXML\Model\Stem();
            $stem->textContent = $visuals['stem'];
            $note->stem = $stem;
            
            $note->instrument = new \MusicXML\Model\Instrument(array('id' => $partId . '-I' . ($noteCode + 1)));
        } else {
            $pitch = $this->getPitch($noteCode);
            $note->pitch = $pitch; // Pitched notes for non-percussion channels
            if(isset($pitch->alter))
            {
                if($pitch->alter->textContent > 0)
                {
                    $accidental = new Accidental();
                    $accidental->textContent = 'sharp';
                    $note->accidental = $accidental;
                }
                else if($pitch->alter->textContent < 0)
                {
                    $accidental = new Accidental();
                    $accidental->textContent = 'flat';
                    $note->accidental = $accidental;
                }
            }
            
            $stem = new \MusicXML\Model\Stem();
            $stem->textContent = 'up';
            $note->stem = $stem;
        }
        $note->notations = array($this->getNotation());
        $duration = $this->fixDuration($originalDuration, $divisions, $timebase);
        if ($duration == 0 && $originalDuration > 0) {
            $duration = 1; // Ensure minimum duration is 1 division
        } 
        $note->duration = new Duration($duration);
        $note->type = new Type(MusicXMLUtil::getNoteType($duration, $divisions));
        $dotsCount = MusicXMLUtil::getNoteDots($duration, $divisions);
        if ($dotsCount > 0) {
            $note->dot = array_fill(0, $dotsCount, new \MusicXML\Model\Dot());
        }

        return $note;
    }

    /**
     * Quantize note duration to the nearest sensible rhythmic value.
     * This helps clean up MIDI performances with slight timing variations.
     *
     * @param int $duration The original duration in MIDI ticks.
     * @param int $timebase The MIDI file's timebase (ticks per quarter note).
     * @return int The quantized duration in MIDI ticks.
     */
    public function quantize($duration, $timebase)
    {
        // More aggressive quantization: snap to the nearest 32nd note.
        // This is crucial for cleaning up human-played MIDI.
        $quantizeUnit = $timebase / 8; // 8th of a quarter note = 32nd note
        if ($quantizeUnit > 0) {
            return (int) (round($duration / $quantizeUnit) * $quantizeUnit);
        }
        return $duration;
    }
    /**
     * Get CC Volume value for a given channel and tick
     *
     * @param int $channelId The MIDI channel ID.
     * @param int $tick The absolute time in ticks.
     * @return int
     */
    public function getVolume($channelId, $tick)
    {
        if (!isset($this->ccVolumeMap[$channelId]) || empty($this->ccVolumeMap[$channelId])) {
            return 100;
        }
        $lastVal = 100;
        foreach ($this->ccVolumeMap[$channelId] as $eventTick => $val) {
            if ($eventTick <= $tick) {
                $lastVal = $val;
            } else {
                break;
            }
        }
        return $lastVal;
    }

    /**
     * Get CC Expression value for a given channel and tick
     *
     * @param int $channelId The MIDI channel ID.
     * @param int $tick The absolute time in ticks.
     * @return int
     */
    public function getExpression($channelId, $tick)
    {
        if (!isset($this->ccExpressionMap[$channelId]) || empty($this->ccExpressionMap[$channelId])) {
            return 127;
        }
        $lastVal = 127;
        foreach ($this->ccExpressionMap[$channelId] as $eventTick => $val) {
            if ($eventTick <= $tick) {
                $lastVal = $val;
            } else {
                break;
            }
        }
        return $lastVal;
    }

    /**
     * Get XML
     */
    public function getXml() {
        return $this->xml;
    }

}