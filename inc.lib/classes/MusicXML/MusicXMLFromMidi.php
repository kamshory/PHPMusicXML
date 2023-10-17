<?php

namespace MusicXML;

use DOMDocument;
use DOMNode;
use Midi\MidiMeasure;
use MusicXML\Exceptions\FileNotFoundException;
use MusicXML\Model\Accidental;
use MusicXML\Model\Attributes;
use MusicXML\Model\Divisions;
use MusicXML\Model\Duration;
use MusicXML\Model\InstrumentName;
use MusicXML\Model\MeasurePartwise;
use MusicXML\Model\MidiChannel;
use MusicXML\Model\MidiInstrument;
use MusicXML\Model\MidiProgram;
use MusicXML\Model\MidiUnpitched;
use MusicXML\Model\Note;
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
use MusicXML\Model\Tie;
use MusicXML\Model\Tied;
use MusicXML\Model\Type;
use MusicXML\Model\Volume;
use MusicXML\Properties\MidiEvent;
use MusicXML\Properties\TieStop;
use MusicXML\Properties\TimeSignature;
use MusicXML\Util\MXL;

/**
 * Convert MIDI to MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/tutorial/midi-compatible-part/
 */
class MusicXMLFromMidi extends MusicXMLBase
{
    
    const DEFAULT_DIVISONS = 24;
    private $widthScale = 6;
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

    private $noteMin = 127;
    private $noteMax = 0;
    private $maxMeasure = 0;
    private $lastNote = array(); 

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

    private function addPartList(
        $channelId, 
        $partId,
        $programId,
        $instrumentId,
        $instrument,
        $port
    )
    {
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
     * @param mixed $n
     * @param mixed $ch
     * @param mixed $v
     * @return void
     */
    private function addEvent($eventName, $message, $timebase, $abstime, $n = 0, $ch = 0, $v = 0) //NOSONAR
    {
        $rawtime = $message[0];
        $tm = $message[0] / ($this->timeSignature->getBeats() * $timebase);
        $tmInteger = floor($tm);
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
            throw new FileNotFoundException("Specified file does not exists: ".$midiPath);
        }
    }
    
    /**
     * Convert MIDI to MusicXML
     *
     * @param MidiMeasure $midi
     * @param string $version Version of MusicXML
     * @return string
     */
    public function midiToMusicXml($midi, $title, $version = "4.0", $format = MXL::FORMAT_XML)
    {
        $domdoc = $this->getDOMDocument();
        $midi2mxl = new MusicXMLFromMidi();
        $domdoc->appendChild($midi2mxl->convertMidiToMusicXML($midi, $title, $domdoc, $version));
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

                        $instrument = MusicXMLUtil::getInstrumentName($p, $ch);

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
                        $this->addEvent($msg[1], $msg, $timebase, $abstime, $p, $ch);
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
                        // add event
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
                        $this->addEvent($msg[1], $msg, $timebase, $abstime, $n, $ch, $v);

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

                        // add event
                        $this->addEvent($msg[1], $msg, $timebase, $abstime, $c, $ch, $v);

                        $xml .= "<ControlChange Channel=\"$ch\" Control=\"$c\" Value=\"$v\"/>\n";
                        break;

                    case 'ChPr':
                        eval("\$" . $msg[2] . ';'); // ch
                        eval("\$" . $msg[3] . ';'); // v

                        $ch = isset($ch) ? $ch : 0;
                        $v = isset($v) ? $v : 0;
                        // add event
                        $this->addEvent($msg[1], $msg, $timebase, $abstime, 0, $ch, $v);
                        $xml .= "<ChannelKeyPressure Channel=\"$ch\" Pressure=\"$v\"/>\n";
                        break;

                    case 'Pb':
                        eval("\$" . $msg[2] . ';'); // ch
                        eval("\$" . $msg[3] . ';'); // v

                        $ch = isset($ch) ? $ch : 0;
                        $v = isset($v) ? $v : 0;
                        $this->addEvent($msg[1], $msg, $timebase, $abstime, 0, $ch, $v);
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
                        $xml .= "<TimeSignature Numerator=\"{$ts[0]}\" LogDenominator=\"" . log($ts[1]) / log(2) . "\" MIDIClocksPerMetronomeClick=\"{$msg[3]}\" ThirtySecondsPer24Clocks=\"{$msg[4]}\"/>\n";
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
        
        $this->buildTimeDivisions($timebase);
        
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
                    $this->getIsntrumentSound($channelId, $programId, $instrumentName);
                    $instrumentSound = strtolower(str_replace(' ', '.', $part['instrument'][0]));
                }
                $midiChannel = $part['channelId'];
                $midiProgramId = $part['programId'];
                $instrumentId = $part['instrumentId'];
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
            
            $this->clefs[$channelId] = MusicXMLUtil::getClef($this->noteMin, $this->noteMax);
            
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
     * @param array $part
     * @param integer $partId
     * @param integer $channelId
     * @param integer $programId
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
            $scoreInstrument->id = $id; 
            $midiCode = $value['note'] - 1;
            if(isset(MusicXMLInstrument::DRUM_SET[$midiCode]) && isset(MusicXMLInstrument::DRUM_SET[$midiCode][0]))
            {
                $scoreInstrument->instrumentName = new InstrumentName(MusicXMLInstrument::DRUM_SET[$midiCode][0]);
            }
            else
            {
                $scoreInstrument->instrumentName = new InstrumentName('Instrument ' . $key);
            }
            $midiInstrument->id = $id;
            $midiInstrument->midiChannel = new MidiChannel($channelId);
            $midiInstrument->midiProgram = new MidiProgram($programId);
            $midiInstrument->midiUnpitched = new MidiUnpitched($key);
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
     * @param [type] $timebase
     * @return void
     */
    private function buildTimeDivisions($timebase)
    {
        foreach($this->measures as $measure)
        {
            foreach($measure as $measureIndex => $events)
            {
                $minDuration = $timebase;
                foreach($events as $event)
                {
                    if(isset($event['channel']) && $event['channel'] != 10 &&  isset($event['duration']) && $event['duration'] > 0 && $event['duration'] < $minDuration)
                    {
                        $minDuration = $event['duration'];
                    }
                }
                $divisions = ceil($timebase * 24 / $minDuration);
                if($divisions > self::DEFAULT_DIVISONS)
                {
                    $divisions = self::DEFAULT_DIVISONS;
                }
                $this->setMeasureDivisions($measureIndex, $divisions);
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
     * Get measure division
     *
     * @param integer $measureIndex
     * @return integer
     */
    private function getDivisions($measureIndex)
    {
        return isset($this->measureDivisions[$measureIndex]) ? $this->measureDivisions[$measureIndex] : 1;
    }

    /**
     * Get measure width
     *
     * @param integer $measureIndex
     * @return float
     */
    private function getWidth($measureIndex)
    {
        return isset($this->measureWidth[$measureIndex]) ? $this->measureWidth[$measureIndex] : $this->minWidth;
    }

    /**
     * Get measure
     *
     * @param string $partId
     * @param integer $channelId
     * @param integer $measureIndex
     * @return MeasurePartwise
     */
    private function getMeasure($partId, $channelId, $measureIndex, $timebase)
    {
        $measure = new MeasurePartwise();
        $attributes = new Attributes();
        $measure->number = $measureIndex+1;
        $directions = array();
        
        if ($this->hasMessage(0, $measureIndex))
        {
            $midiEventMessages = $this->measures[0][$measureIndex];
            
            // events whithout channel information
            $controlEvents0 = MusicXMLUtil::getControlEvent($midiEventMessages);
            $midiEvent = $this->getEventList($controlEvents0);
            $tempoList = $midiEvent->getTempoList();
            $keySignatureList = $midiEvent->getKeySignatureList();

            if(!empty($tempoList))
            {
                $directions = MusicXMLUtil::getDirections($tempoList);
            } 
            if(!empty($keySignatureList))
            {
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
            
            if (!empty($controlEvents)) 
            {
                foreach ($controlEvents as $message) //NOSONAR
                {
                    // do it here
                }
            }

            // begin add attribute
            
            $divisions = $this->getDivisions($measureIndex);
            $attributes->divisions = new Divisions($divisions);
            if($measureIndex == 0)
            {                   
                // only add clef on first
                $attributes->time = $this->getTime($this->timeSignature);           
                $attributes->clef = $this->clefs[$channelId];                
                if(count($attributes->clef) > 1)
                {
                    $attributes->staves = new Staves(count($attributes->clef));
                }     
            }
        }
        else
        {
            $attributes = new Attributes();
            $attributes->divisions = $this->getDivisions($measureIndex);            
        }
        
        // add attribute
        $measure->elements[] = $attributes;
        
        // add directions
        if(!empty($directions))
        {
            foreach($directions as $direction)
            {
                $measure->elements[] = $direction;
            }
        }

        
        if ($this->hasMessage($channelId, $measureIndex)) 
        {
            // begin add note
            
            $noteMessages = MusicXMLUtil::getNotes($midiEventMessages);
            if(!empty($noteMessages))
            {
                $measure = $this->addMeasureElement($measureIndex, $measure, $noteMessages, $channelId, $divisions, $timebase);
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
                    $elementIndex = MusicXMLUtil::getElementIndexFromNoteIndex($measure, $idx);
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
            $beams = MusicXMLUtil::getBeams($measure, $noteMessages, $timebase, $this->timeSignature);
            if($beams !== false)
            {
                foreach($beams as $beamNote)
                {
                    $measure->elements[$beamNote->index]->beam = $beamNote->beam;
                }
            }
        }  
        
        
        return $measure;
    }

    private $tieStop = array();

    /**
     * Add element to measure
     *
     * @param integer $measureIndex
     * @param MeasurePartwise $measure
     * @param array $noteMessages
     * @param integer $channelId
     * @param integer $divisions
     * @param integer $timebase
     * @return MeasurePartwise
     */
    private function addMeasureElement($measureIndex, $measure, $noteMessages, $channelId, $divisions, $timebase)
    {
        $lastEnd = 0;
        $cnt = 0;
        $offset = 0;
        $end = 0;
        $max = $timebase * $this->timeSignature->getBeats();

        // before add current note, if this measure has tie stop, create it first
        if(isset($this->tieStop[$measureIndex]))
        {
            foreach($this->tieStop[$measureIndex] as $tieStop)
            {
                // add tie note
                $measure->elements[] = $tieStop->getNote();
            }
        }

        foreach ($noteMessages as $message) {
            $duration = isset($message['duration']) ? $message['duration'] : 0;
            if ($this->adible($message, $duration)) {
                $offset = $message['abstime'];
                if ($this->isFirstNote($offset, $cnt)) {
                    $mod = $offset % ($this->timeSignature->getBeats() * $timebase);
                    if ($mod > 0) {
                        // add rest at the beginning
                        $noteRest = $this->createRestNote($measureIndex, $message, $divisions, $timebase, $mod, true);
                        
                        // add rest note
                        $measure->elements[] = $noteRest;

                        $end = $offset + $mod;
                        if ($lastEnd <= $end) {
                            $lastEnd = $end;
                        }
                    }
                }

                $length = isset($message['duration']) ? $message['duration'] : 0;
                $end = $offset + $length;

                if ($this->needRestMiddle($offset, $lastEnd)) {
                    // add rest at the middle
                    $mod = $offset - $lastEnd;
                    $noteRest2 = $this->createRestNote($measureIndex, $message, $divisions, $timebase, $mod, true);
                    
                    // add rest note
                    $measure->elements[] = $noteRest2;
                }

                if ($lastEnd <= $end) {
                    $lastEnd = $end;
                }

                $note = $this->createSoundNote($measureIndex, $channelId, $message, $divisions, $timebase, $duration);


                $toffset = $message['abstime'] % ($timebase * $this->timeSignature->getBeats());
                
                $tend = $toffset + $duration;
                if($tend > $max)
                {
                    $originalDuration = $note->duration->textContent;
                    $note = $this->trimNoteDuration($note, $toffset, $divisions, $timebase, $duration, $tend, $max);
                    $remaining = $originalDuration - $note->duration->textContent;
                    $tieRange = $remaining / $this->timeSignature->getBeats();
                    $nextMeasureIndex = $measureIndex + ceil($tieRange/$divisions);
                    if(!isset($this->tieStop[$nextMeasureIndex]))
                    {
                        $this->tieStop[$nextMeasureIndex] = array();
                    }
                    $timeRemaining = $message['duration'] - ($duration * $divisions / $timebase);
                    

                    $durationRemaining = $remaining % ($divisions * $this->timeSignature->getBeats());
                    

                    $this->tieStop[$nextMeasureIndex][] = $this->createTieStop($nextMeasureIndex, $measureIndex, $note, $tieRange, $durationRemaining, $timeRemaining, $divisions);
                }             

                // add note
                $measure->elements[] = $note;
                $cnt++;
            }
        }

        $modEnd = $lastEnd % ($this->timeSignature->getBeats() * $timebase);

        if ($this->needRestEnd($modEnd, $cnt, $max)) {
            // add rest at the end
            $duration = $modEnd / $this->timeSignature->getBeats();
            $note = $this->createRestNote($measureIndex, $message, $divisions, $timebase, $duration);
            $measure->elements[] = $note;
        }
        file_put_contents('test.txt', print_r($this->tieStop, true));

        return $measure;
    }

    private function createTieStop($nextMeasureIndex, $measureIndex, $note, $tieRange, $durationRemaining, $timeRemaining, $divisions)
    {
        return new TieStop($nextMeasureIndex, $measureIndex, $note, $tieRange, $durationRemaining, $timeRemaining, $divisions);
    }

    /**
     * Check if note is trimmed or note
     *
     * @param Note $note
     * @return boolean
     */
    private function isTrimmed($note)
    {
        echo "IS TRIMMED ".$note->tie."\r\n";
        return isset($note->tie) && isset($note->tie->type);
    }

    /**
     * Trim note duration
     *
     * @param Note $note
     * @param integer $toffset Offset of note
     * @param integer $divisions
     * @param integer $timebase
     * @param integer $duration Original duration
     * @param integer $tend Actual time end of note
     * @param integer $max Maximum time of measure
     * @return Note
     */
    private function trimNoteDuration($note, $toffset, $divisions, $timebase, $duration, $tend, $max)
    {
        $newDuration = $max - $toffset;
        //echo "MAX = $max\r\n";
        //echo "toffset = $toffset\r\n";
        //echo "NEW DURATION = $newDuration\r\n";
        
        while($newDuration < 0)
        {
            $newDuration += $timebase;
        }
        //echo "NEW DURATION = $newDuration\r\n";
        if($duration > 0)
        {
            $newDuration = $this->fixDuration($newDuration, $divisions, $timebase);
            //echo "NEW DURATION = $newDuration\r\n";
            $note->duration = new Duration($newDuration);                                
            $note->type = new Type(MusicXMLUtil::getNoteType($newDuration, $divisions));                
            $note->release = $note->attack + $newDuration;
            $tie = new Tie();
            $tie->type = 'start';
            $tied = new Tied();
            $tied->type = 'start';
            $note->tie = $tie;
            $note->notations[0]->tied = $tied;
        }
        return $note;
    }

    private function needRestMiddle($offset, $lastEnd)
    {
        return $offset > $lastEnd && $lastEnd > 0;
    }

    private function needRestEnd($modEnd, $cnt, $max)
    {
        return $max > $modEnd && $modEnd > 0 && $cnt > 0;
    }

    private function isFirstNote($offset, $cnt)
    {
        return $offset > 0 && $cnt == 0;
    }

    private function adible($message, $duration)
    {
        return $duration > 0 && $message['event'] == 'On' && $message['value'] > 0 && $message['note'] > 13;
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
        $duration = $this->fixDuration($duration, $divisions, $timebase);
        $note->duration = new Duration($duration);
        $note->type = new Type(MusicXMLUtil::getNoteType($duration, $divisions));    
        if($begining)
        {
            $note->attack = 0;
            $note->release = $duration;
        }
        else
        {
            $attackRelease = MusicXMLUtil::getAttackRelease($measureIndex, $message, $timebase, $this->timeSignature, $duration);
            $note->attack = $attackRelease->getAttack();
            $note->release = $attackRelease->getRelease();    
        }
        return $note;
    }

    /**
     * Create sound note
     *
     * @param integer $measureIndex
     * @param integer $channelId
     * @param array $message
     * @param integer $divisions
     * @param integer $timebase
     * @param integer $duration
     * @return Note
     */
    private function createSoundNote($measureIndex, $channelId, $message, $divisions, $timebase, $duration)
    {
        $noteCode = $message['note'];
        $note = new Note();
            
        $note->voice = $channelId;

        $note->dynamics = round($message['value'] / 0.9, 2);
        $pitch = $this->getPitch($noteCode);
        $note->pitch = $pitch;
        if(isset($pitch->alter))
        {
            if($pitch->alter->textContent > 0)
            {
                $accidental = new Accidental();
                $accidental->textContent = 'sharp';
                $note->accidental = $accidental;
            }
            else if($pitch->alter < 0)
            {
                $accidental = new Accidental();
                $accidental->textContent = 'flat';
                $note->accidental = $accidental;
            }
        }
        $note->stem = 'up';
        $note->notations = array($this->getNotation());
        $duration = $this->fixDuration($duration, $divisions, $timebase);
        $note->duration = new Duration($duration);                    
        
        $note->type = new Type(MusicXMLUtil::getNoteType($duration, $divisions));            
        
        $attackRelease = MusicXMLUtil::getAttackRelease($measureIndex, $message, $timebase, $this->timeSignature, $duration);
        $note->attack = $attackRelease->getAttack();
        $note->release = $attackRelease->getRelease();

        return $note;
    }
    
}