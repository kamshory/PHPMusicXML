<?php

namespace MusicXML;

use DOMDocument;
use DOMNode;
use Midi\MidiMeasure;
use MusicXML\Exceptions\FileNotFoundException;
use MusicXML\Model\Accidental;
use MusicXML\Model\Attributes;
use MusicXML\Model\Chord;
use MusicXML\Model\DisplayOctave;
use MusicXML\Model\DisplayStep;
use MusicXML\Model\Divisions;
use MusicXML\Model\Duration;
use MusicXML\Model\InstrumentName;
use MusicXML\Model\MeasurePartwise;
use MusicXML\Model\MidiChannel;
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

    const DEFAULT_DIVISONS = 24;

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
        $this->maxMeasure = 0;
        $this->lastNote = array();
        $this->divisionsPerQuarter = 0;
        $this->tieStop = array();
        $this->tieContinue = array();
        $this->measureOnsets = array();
        $this->lyrics = array();
    }

    /**
     * Set selected channels
     *
     * @param array $selectedChannels
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
     * @param integer $ch
     * @param integer $indexOn
     * @param float $duration
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
     * @param integer $channelId
     * @param integer $partId
     * @param integer $programId
     * @param integer $instrumentId
     * @param array $instrument
     * @param integer $port
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
     * @param string $eventName Event name
     * @param array $message Parse message
     * @param integer $timebase Timebase
     * @param integer $abstime Absolute time
     * @param mixed $n
     * @param mixed $ch
     * @param mixed $v
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
                $this->lyrics[$ch][$abstime] = $lyricText;
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
     * @param string $midiPath
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
     * @param string $midiString
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
     * @param MidiMeasure $midi
     * @param string $title
     * @param string $version Version of MusicXML
     * @param string $format
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
     * @param MidiMeasure $midi
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
                            $this->channel10[$n + 1] = array('note' => $n + 1, 'ch' => $ch, 'n' => $n, 'v' => $v, 'message' => $msg);
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
    }

    /**
     * Get measure division
     *
     * @param integer $measureIndex (This parameter is now unused as divisions are global)
     * @return integer
     */
    private function getDivisions($measureIndex)
    {
        return $this->divisionsPerQuarter;
    }

    /**
     * Ger part ab
     *
     * @param array $part
     * @return string
     */
    private function getPartAbbreviation($part)
    {
        return isset($part) && isset($part['instrument']) && isset($part['instrument'][1]) ? $part['instrument'][1] : $part['instrument'][0];
    }

    /**
     * Get part volume
     *
     * @param integer $partId
     * @return integer
     */
    private function getPartVolume($partId)
    {
        return isset($this->partVolume[$partId]) ? $this->partVolume[$partId] : 0;
    }

    /**
     * Get part pan
     *
     * @param integer $partId
     * @return integer
     */
    private function getPartPan($partId)
    {
        return isset($this->partPan[$partId]) ? $this->partPan[$partId] : 0;
    }

    /**
     * Check if note is audible or not
     *
     * @param array $message
     * @param integer $duration
     * @return boolean
     */
    private function isAudible($message, $duration)
    {
        return $duration > 0 && $message['event'] == 'On' && $message['value'] > 0 && $message['note'] > 13;
    }

    /**
     * Convert Midi to MusicXML
     *
     * @param MidiMeasure $midi
     * @param string $title
     * @param DOMDocument $domdoc
     * @param string $version
     * @return DOMNode
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

        $this->divisionsPerQuarter = $timebase; // Set global divisions to MIDI timebase

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
                $this->clefs[$channelId] = MusicXMLUtil::getClef($this->noteMin, $this->noteMax);
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
                $percussionClef = new \MusicXML\Model\Clef(array('sign' => new \MusicXML\Model\Sign('percussion')));
                $this->clefs[$channelId] = array($percussionClef);
            } else {
                $this->clefs[$channelId] = MusicXMLUtil::getClef($this->noteMin, $this->noteMax);
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

        // begin process pitch bend
        // TODO: process pitch bend here
        // end process pitch bend


        // begin process chord
        // TODO: process chord here
        // end process chord


        // begin part

        foreach ($this->partList as $part) {
            $partId = $part['partId'];
            $channelId = $part['channelId'];
            
            // Clear tie continuation for the specific part before processing
            unset($this->tieContinue[$channelId]);

            $part = new PartPartwise();
            $part->id = $partId;
            $part->measure = array();
            for ($measureIndex = 0; $measureIndex < $totalMeasure; $measureIndex++) {
                $measure = $this->getMeasure($partId, $channelId, $measureIndex, $timebase);
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
     * @param integer $partId
     * @param integer $channelId
     * @param integer $programId
     * @param string $partName
     * @param string $partAbbreviation
     * @return ScorePart
     */
    private function getScorePartChannel10($partId, $channelId, $programId, $partName, $partAbbreviation)
    {
        $scorePart = new ScorePart();
        $scorePart->id = $partId;
        $scorePart->scoreInstrument = array();
        $scorePart->midiInstrument = array();

        $scorePart->partName = new PartName($partName);
        $scorePart->partAbbreviation = new PartAbbreviation($partAbbreviation);
        ksort($this->channel10);
        foreach ($this->channel10 as $key => $value)
        {
            $scoreInstrument = new ScoreInstrument();
            $midiInstrument = new MidiInstrument();
            $id = $partId . '-I' . $key;
            $drumSound = 'percussion.drums'; // Default generic drum sound
            $scoreInstrument->id = $id;
            $midiCode = $value['note'] - 1;
            
            if (isset(MusicXMLInstrument::DRUM_SET[$midiCode])) 
            {
                if (isset(MusicXMLInstrument::DRUM_SET[$midiCode][0])) {
                    $scoreInstrument->instrumentName = new InstrumentName(MusicXMLInstrument::DRUM_SET[$midiCode][0]);
                }
                if (isset(MusicXMLInstrument::DRUM_SET[$midiCode][2])) {
                    $drumSound = MusicXMLInstrument::DRUM_SET[$midiCode][2];
                }
            }
            
            if (!isset($scoreInstrument->instrumentName))
            {
                $scoreInstrument->instrumentName = new InstrumentName('Instrument ' . $key);
            }
            $scoreInstrument->instrumentSound = new \MusicXML\Model\InstrumentSound($drumSound);
            $midiInstrument->id = $id;
            $midiInstrument->midiChannel = new MidiChannel($channelId);
            $midiInstrument->midiProgram = new MidiProgram($programId);
            $midiInstrument->midiUnpitched = new MidiUnpitched($midiCode);
            $volume = isset($value['v']) ? round($value['v'] * 100 / 127, 2) : 0.0;
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
     * @param integer $channelId
     * @param integer $measureIndex
     * @return boolean
     */
    private function hasMessage($channelId, $measureIndex)
    {
        return isset($this->measures[$channelId]) && isset($this->measures[$channelId][$measureIndex]);
    }

    /**
     * Get MIDI Events
     *
     * @param array $controlEvents
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
                $rawtime = $message['rawtime'];
                $tempo = $message['value'];
                $bpm = round((60000000/$tempo));
                $tempoList[$time] = array('rawtime'=>$rawtime, 'tempo'=>$tempo, 'bpm'=>$bpm);
            }
            if($message['event'] == 'KeySig')
            {
                $fifths = 3;
                if($message['mode'] == 'minor')
                {
                    $fifths = $fifths * -1;
                }
                $keySignatureList[$time] = array('fifths'=>$fifths, 'mode'=>$message['mode']);
            }
        }
        return new MidiEvent($tempoList, $keySignatureList);
    }

    /**
     * Build measure divisions
     *
     * @param integer $timebase
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
     * Set measure divison
     *
     * @param integer $measureIndex
     * @param float $divisions
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
     * @param string $partId
     * @param integer $channelId
     * @param integer $measureIndex
     * @param integer $timebase
     * @return MeasurePartwise
     */
    private function getMeasure($partId, $channelId, $measureIndex, $timebase)
    {
        $measure = new MeasurePartwise();
        $attributes = new Attributes();
        $measure->number = $measureIndex + 1;
        if (isset($this->measureWidth[$measureIndex])) {
            $measure->width = $this->measureWidth[$measureIndex];
        }
        $directions = [];
        $divisions = $this->divisionsPerQuarter;
        $noteMessages = array();

        if ($this->hasMessage(0, $measureIndex)) {
            $midiEventMessages = $this->measures[0][$measureIndex];

            // events whithout channel information
            $controlEvents0 = MusicXMLUtil::getControlEvent($midiEventMessages);
            $midiEvent = $this->getEventList($controlEvents0);
            $tempoList = $midiEvent->getTempoList();
            $keySignatureList = $midiEvent->getKeySignatureList();

            if(!empty($tempoList)) {
                $directions = MusicXMLUtil::getDirections($tempoList);
            }
            if(!empty($keySignatureList)) {
                $attributes->key = array();
                foreach($keySignatureList as $keySignature)
                {
                    $attributes->key[] = $this->getKey($keySignature['fifths'], $keySignature['mode']);
                }
            }
        }

        if ($this->hasMessage($channelId, $measureIndex)) {
            $midiEventMessages = $this->measures[$channelId][$measureIndex];
            $controlEvents = MusicXMLUtil::getControlEvent($midiEventMessages);

            if (!empty($controlEvents)) {
                foreach ($controlEvents as $message) //NOSONAR
                {
                    // do it here
                }
            }

            // Divisions are now global, no need to fetch per measure
            $attributes->divisions = new Divisions($divisions);
            if($measureIndex == 0) {
                // only add clef on first
                $attributes->time = $this->getTime($this->timeSignature);
                $attributes->clef = $this->clefs[$channelId];
                if(count($attributes->clef) > 1) {
                    $attributes->staves = new Staves(count($attributes->clef));
                }
            }
        }
        else { // If no messages in this channel for this measure, still set divisions
            $attributes = new Attributes();
            $attributes->divisions = new Divisions($this->getDivisions($measureIndex));
        }
        $measure->elements[] = $attributes;

        // add attribute

        // add directions
        if(!empty($directions)) {
            foreach($directions as $direction)
            {
                $measure->elements[] = $direction;
            }
        }

        if ($this->hasMessage($channelId, $measureIndex))
        {
            // begin add note

            $noteMessages = MusicXMLUtil::getNotes($midiEventMessages);
            // Urutkan pesan nada berdasarkan waktu absolut untuk memastikan deteksi chord bekerja
            usort($noteMessages, function($a, $b) {
                if ($a['abstime'] == $b['abstime']) {
                    return 0;
                }
                return ($a['abstime'] < $b['abstime']) ? -1 : 1;
            });

            if(!empty($noteMessages)) {
                $measureContainer = $this->addMeasureElement($measureIndex, $measure, $noteMessages, $partId, $channelId, $divisions, $timebase);

                // add element index to $noteMessages
                $measure = $measureContainer->getMeasurePartwise();
                $noteMessages = $measureContainer->getNoteMessages();
            }
            // end add note


            if (!empty($controlEvents))
            {
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
     * Add element to measure
     *
     * @param integer $measureIndex
     * @param MeasurePartwise $measure
     * @param array $noteMessages
     * @param string $partId
     * @param integer $channelId
     * @param integer $divisions
     * @param integer $timebase
     * @return MeasurePartwiseContainer
     */
    private function addMeasureElement($measureIndex, $measure, $noteMessages, $partId, $channelId, $divisions, $timebase)
    {
        $measureLength = $timebase * $this->timeSignature->getBeats();
        $xmlMeasureLength = $this->timeSignature->getBeats() * $divisions;
        $xmlCursor = 0;
        $prevAbstime = -1;

        // Check if there is a continued tie from the previous measure for this part
        if (isset($this->tieContinue[$channelId]) && !empty($this->tieContinue[$channelId])) {
            $firstTie = true;
            foreach ($this->tieContinue[$channelId] as $noteCode => $tieInfo) {
                $remainingDuration = $tieInfo['duration'];
                $continueDuration = min($remainingDuration, $measureLength);

                $xmlEnd = (int) round($continueDuration * $divisions / $timebase);
                $xmlDuration = $xmlEnd; // Starts at 0
                if ($xmlDuration <= 0 && $continueDuration > 0) $xmlDuration = 1;

                $note = new Note();
                $note->voice = $channelId;
                $note->pitch = $this->getPitch($noteCode);
                $note->notations = array($this->getNotation());
                
                if (!$firstTie) {
                    $note->chord = new Chord();
                }

                if ($remainingDuration <= $measureLength) {
                    $note->notations[0]->tied = array(new \MusicXML\Model\Tied(array('type'=>'stop')));
                    $note->tie = new \MusicXML\Model\Tie(array('type'=>'stop'));
                } else {
                    $note->notations[0]->tied = array(
                        new \MusicXML\Model\Tied(array('type'=>'stop')),
                        new \MusicXML\Model\Tied(array('type'=>'start'))
                    );
                    $note->tie = array(
                        new \MusicXML\Model\Tie(array('type'=>'stop')),
                        new \MusicXML\Model\Tie(array('type'=>'start'))
                    );
                }

                $note->duration = new Duration($xmlDuration);
                $note->type = new Type(MusicXMLUtil::getNoteType($xmlDuration, $divisions));
                
                $absTime = $measureIndex * $measureLength;
                if (isset($this->measureOnsets[$measureIndex][$absTime])) {
                    $note->defaultX = $this->measureOnsets[$measureIndex][$absTime];
                }

                $measure->elements[] = $note;
                if ($firstTie) $xmlCursor += $xmlDuration;
                $prevAbstime = $measureIndex * $measureLength;

                if ($remainingDuration > $measureLength) {
                    $this->tieContinue[$channelId][$noteCode]['duration'] -= $measureLength;
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
            $duration = $this->quantize($duration, $timebase);
            
            if ($this->isAudible($message, $duration)) {
                
                $offsetTicks = $message['abstime'] % $measureLength;
                $xmlStart = (int) round($offsetTicks * $divisions / $timebase);
                
                /**
                 * SEBELUMNYA: $isChord = ($xmlStart <= $xmlCursor && $idx > 0) || ...
                 * Ini salah karena nada yang mulai tepat saat nada sebelumnya habis dianggap chord.
                 * 
                 * SEKARANG: Chord hanya jika abstime benar-benar sama.
                 */
                $isChord = ($idx > 0 && $message['abstime'] == $prevAbstime);

                if (!$isChord && $xmlStart > $xmlCursor) {
                    $xmlGap = $xmlStart - $xmlCursor;
                    $noteRest = $this->createRestNote($measureIndex, $message, $divisions, $timebase, 0, $xmlCursor == 0);
                    $noteRest->duration = new Duration($xmlGap);
                    $noteRest->type = new Type(MusicXMLUtil::getNoteType($xmlGap, $divisions));
                    $measure->elements[] = $noteRest;
                    $xmlCursor = $xmlStart;
                }

                $note = $this->createSoundNote($measureIndex, $partId, $channelId, $message, $divisions, $timebase, $duration);

                // Attach lyrics if available at this abstime
                $lyricText = isset($this->lyrics[$channelId][$message['abstime']]) ? $this->lyrics[$channelId][$message['abstime']] : (isset($this->lyrics[0][$message['abstime']]) ? $this->lyrics[0][$message['abstime']] : null);
                
                /**
                 * Sesuai permintaan, lirik hanya dilampirkan pada channel 4.
                 * Hal ini mencegah lirik muncul tumpang tindih di banyak staff
                 * dan mengikuti konvensi umum pada MuseScore.
                 */
                if ($lyricText !== null && !$isChord && $channelId == 4) {
                    $lyric = new Lyric();
                    $lyric->text = array(new TextElement($lyricText));
                    $lyric->justify = 'center';
                    $note->lyric = array($lyric);
                }

                // Atur koordinat X eksplisit
                if (isset($this->measureOnsets[$measureIndex][$message['abstime']])) {
                    $note->defaultX = $this->measureOnsets[$measureIndex][$message['abstime']];
                }

                if ($isChord) {
                    $note->chord = new Chord();
                }

                $localEndTicks = $offsetTicks + $duration;
                if ($localEndTicks > $measureLength) {
                    $durationInMeasure = $measureLength - $offsetTicks;
                    $remainingDuration = $duration - $durationInMeasure;
                    $note = $this->trimNoteDuration($note, $durationInMeasure, $divisions, $timebase);
                    $xmlDuration = $note->duration->textContent;
                    
                    $this->tieContinue[$channelId][$message['note']] = array(
                        'duration' => $remainingDuration,
                    );
                } else {
                    $xmlDuration = $note->duration->textContent;
                }

                $measure->elements[] = $note;
                if (!$isChord) $xmlCursor += $xmlDuration;
                $prevAbstime = $message['abstime']; // Update prevAbstime for chord detection
                $noteMessages[$idx]['elementIndex'] = count($measure->elements) - 1;
            }
        }

        // add rest to fill the measure, if needed
        if ($xmlCursor < $xmlMeasureLength) {
            $xmlRemain = $xmlMeasureLength - $xmlCursor;
            $note = $this->createRestNote($measureIndex, isset($message) ? $message : array(), $divisions, $timebase, 0, $xmlCursor == 0);
            $note->duration = new Duration($xmlRemain);
            $note->type = new Type(MusicXMLUtil::getNoteType($xmlRemain, $divisions));
            
            $absTime = ($measureIndex * $measureLength) + (int)round($xmlCursor * $timebase / $divisions);
            if (isset($this->measureOnsets[$measureIndex][$absTime])) {
                $note->defaultX = $this->measureOnsets[$measureIndex][$absTime];
            }
            $measure->elements[] = $note;
        }

        return new MeasurePartwiseContainer($measure, $noteMessages);
    }

    /**
     * Trim note duration
     * Split note when it exceeds measure boundary, applying tie notation
     *
     * @param Note $note
     * @param integer $newRawDuration New duration in MIDI ticks
     * @param integer $divisions
     * @param integer $timebase
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
     * @param integer $measureIndex
     * @param array $message
     * @param integer $divisions
     * @param integer $timebase
     * @param integer $duration
     * @param boolean $begining
     * @return Note
     */
    private function createRestNote($measureIndex, $message, $divisions, $timebase, $duration, $begining = false)
    {
        $note = new Note();
        $rest = new Rest();
        $note->rest = $rest;
        $rawDuration = $duration;
        $duration = $this->fixDuration($rawDuration, $divisions, $timebase);
        if ($duration == 0 && $rawDuration > 0) {
            $duration = 1;
        }
        $note->duration = new Duration($duration);
        $note->type = new Type(MusicXMLUtil::getNoteType($duration, $divisions));
        return $note;
    }

    /**
     * Create sound note
     *
     * @param integer $measureIndex
     * @param string $partId
     * @param integer $channelId
     * @param array $message
     * @param integer $divisions
     * @param integer $timebase
     * @param integer $originalDuration
     * @return Note
     */
    private function createSoundNote($measureIndex, $partId, $channelId, $message, $divisions, $timebase, $originalDuration)
    {
        $noteCode = $message['note'];
        $note = new Note();
        $note->voice = $channelId;

        if ($channelId == 10) { // Percussion handling
            // MusicXML unpitched notes for percussion
            $note->unpitched = new Unpitched();
            // Pemetaan standar: Kick di F4, Snare di C5, Lainnya (Hi-hat/Cymbal) di G5
            $note->unpitched->displayStep = new DisplayStep(($noteCode == 35 || $noteCode == 36) ? 'F' : (($noteCode == 38 || $noteCode == 40) ? 'C' : 'G'));
            $note->unpitched->displayOctave = new DisplayOctave(($noteCode == 35 || $noteCode == 36) ? 4 : 5);
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
        }
        
        $note->stem = 'up'; // Default stem direction
        $note->notations = array($this->getNotation());
        $duration = $this->fixDuration($originalDuration, $divisions, $timebase);
        if ($duration == 0 && $originalDuration > 0) {
            $duration = 1; // Ensure minimum duration is 1 division
        } 
        $note->duration = new Duration($duration);
        $note->type = new Type(MusicXMLUtil::getNoteType($duration, $divisions));

        return $note;
    }

}