<?php

namespace MusicXML;

use DOMDocument;
use DOMNode;
use Midi\MidiMeasure;
use MusicXML\Map\ModelMap;
use MusicXML\Map\NodeType;
use MusicXML\Model\Attributes;
use MusicXML\Model\Clef;
use MusicXML\Model\Direction;
use MusicXML\Model\DirectionType;
use MusicXML\Model\Key;
use MusicXML\Model\Measure;
use MusicXML\Model\Metronome;
use MusicXML\Model\MidiInstrument;
use MusicXML\Model\Note;
use MusicXML\Model\Part;
use MusicXML\Model\PartList;
use MusicXML\Model\ScoreInstrument;
use MusicXML\Model\ScorePart;
use MusicXML\Model\ScorePartWise;
use MusicXML\Model\Sound;
use MusicXML\Model\Time;
use MusicXML\Model\Transpose;
use MusicXML\Properties\MidiEvent;
use MusicXML\Properties\TimeSignature;
use MusicXML\Util\MXL;

/**
 * @version 1.0.0
 */
class MusicXML extends MusicXMLBase
{
 
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
     * Copyright
     *
     * @var string
     */
    private $copyright = "";
    private $timeSignature = null;

    public function loadXml($path)
    {
        $domdoc = new DOMDocument();
        $domdoc->loadXML(file_get_contents($path));
        $nodes = $domdoc->childNodes;
        $object = null;
        foreach($nodes as $node)
        {
            if($node->nodeType == NodeType::ELEMENT && isset(ModelMap::CLASS_MAP[$node->tagName]))
            {
                $className = ModelMap::CLASS_MAP[$node->tagName];
                $object = new $className($node);
                break;
            }
        }
        echo $object;
        
        
    }


    /**
     * Convert MIDI to MusicXML
     *
     * @param MidiMeasure $midi
     * @param string $version Version of MusicXML
     * @return string
     */
    public function midiToMusicXml($midi, $title, $version = "4.0", $format = MXL::XML)
    {
        $domdoc = $this->getDOMDocument();
        $domdoc->appendChild($this->convertMidiToMusicXML($midi, $title, $domdoc, $version));
        if($format == MXL::MXL)
        {
            $mxl = new MXL();
            return $mxl->xmlToMxl($title, $domdoc->saveXML());
        }
        else
        {
            return $domdoc->saveXML();
        }
        
    }

    

    /**
     * Process note duration
     *
     * @return void
     */
    private function processDuration()
    {
        $this->processDuration1();
        $this->processDuration2();
    }

    /**
     * Prepare note information to calculate note duration
     *
     * @return void
     */
    private function processDuration1()
    {
        $lastTime = array();
        foreach ($this->measures as $ch => $chValue) {
            foreach ($chValue as $tmInteger => $tmIntegerValue) {
                foreach ($tmIntegerValue as $note => $noteValue) {
                    if(isset($noteValue['channel']) && isset($noteValue['note']))
                    {
                        $chIdx = $noteValue['channel'];
                        $noteIdx = $noteValue['note'];
                        $index = "n" . $chIdx . "_" . $noteIdx;
                        $lt = $this->getLastTime($lastTime, $index);
                        $duration = $noteValue['time'] - $lt;
                        $this->measures[$ch][$tmInteger][$note]['duration'] = $duration;
                        $this->measures[$ch][$tmInteger][$note]['last'] = $lt;
                        $lastTime[$index] = $noteValue['time'];
                    }
                }
            }
        }
    }

    /**
     * Calculate note duration by information provided before
     *
     * @return void
     */
    private function processDuration2()
    {
        foreach ($this->measures as $ch => $chValue) {
            foreach ($chValue as $tmInteger => $tmIntegerValue) {
                foreach ($tmIntegerValue as $note => $noteValue) {
                    if (isset($this->measures[$ch][$tmInteger][$note]['time']) && isset($this->measures[$ch][$tmInteger][$note]['last'])) {
                        $this->measures[$ch][$tmInteger][$note]['duration'] = $this->measures[$ch][$tmInteger][$note]['time'] - $this->measures[$ch][$tmInteger][$note]['last'];
                    }
                }
            }
        }
    }
    
    /**
     * Get last time
     *
     * @param array $lastTime
     * @param string $index
     * @return float
     */
    private function getLastTime($lastTime, $index)
    {
        if (isset($lastTime[$index])) {
            $lt = $lastTime[$index];
        } else {
            $lt = 0;
        }
        return $lt;
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
        $x = $this->measures[$ch][$indexOn];
        $lastOn = $this->findLastOn($x);
        $this->measures[$ch][$indexOn][$lastOn]['duration'] = $duration;
    }

    /**
     * Find last On
     *
     * @param array $messages
     * @return integer
     */
    public function findLastOn($messages)
    {
        $last = 0;
        foreach ($messages as $idx => $note) {
            if ($note['event'] == 'On') {
                $last = $idx;
            }
        }
        return $last;
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
        $this->partList[$instrumentId] = array('instrumentId' => $instrumentId, 'channelId' => $channelId, 'partId' => $partId, 'programId' => $programId, 'instrument' => $instrument, 'port' => $port);
    }

    /**
     * Add ecent
     *
     * @param string $eventName Event name
     * @param array $message Parse message
     * @param integer $timebase Timebase
     * @param integer $n
     * @param integer $ch
     * @param integer $v
     * @return void
     */
    private function addEvent($eventName, $message, $timebase, $n = 0, $ch = 0, $v = 0)
    {
        $rawtime = $message[0];
        $tm = $message[0] / (4 * $timebase);
        $tmInteger = floor($tm);
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
                'rawtime' => $rawtime, 
                'channel' => $ch, 
                'value' => $v
            );
        }
        else
        {
            $this->measures[$ch][$tmInteger][] = array(
                'event' => $eventName, 
                'message' => $message, 
                'time' => $tm, 
                'channel' => $ch, 
                'note' => $n, 
                'value' => $v
            );
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
                $xml .= "  <Event>\n";
                $xml .= ($ttype == 1) ? "    <Delta>$dt</Delta>\n" : "    <Absolute>$t</Absolute>\n";
                $xml .= '    ';
                switch ($msg[1]) {
                    case 'PrCh':
                        eval("\$" . $msg[2] . ';'); // $ch
                        eval("\$" . $msg[3] . ';'); // $p
                        $ch = isset($ch) ? $ch : 0;
                        $p = isset($p) ? $p : 0;

                        $instrument = $this->getInstrumentName($p, $ch);

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
                        $this->addEvent($msg[1], $msg, $timebase, $p, $ch);
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
                        $this->addEvent($msg[1], $msg, $timebase, $n, $ch, $v);


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
                        $this->addEvent($msg[1], $msg, $timebase, $n, $ch, $v);

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
                        $this->addEvent($msg[1], $msg, $timebase, $c, $ch, $v);

                        $xml .= "<ControlChange Channel=\"$ch\" Control=\"$c\" Value=\"$v\"/>\n";
                        break;

                    case 'ChPr':
                        eval("\$" . $msg[2] . ';'); // ch
                        eval("\$" . $msg[3] . ';'); // v

                        $ch = isset($ch) ? $ch : 0;
                        $v = isset($v) ? $v : 0;
                        // add event
                        $this->addEvent($msg[1], $msg, $timebase, 0, $ch, $v);
                        $xml .= "<ChannelKeyPressure Channel=\"$ch\" Pressure=\"$v\"/>\n";
                        break;

                    case 'Pb':
                        eval("\$" . $msg[2] . ';'); // ch
                        eval("\$" . $msg[3] . ';'); // v

                        $ch = isset($ch) ? $ch : 0;
                        $v = isset($v) ? $v : 0;
                        $this->addEvent($msg[1], $msg, $timebase, 0, $ch, $v);
                        $xml .= "<PitchBendChange Channel=\"$ch\" Value=\"$v\"/>\n";
                        break;

                    case 'Seqnr':
                        $xml .= "<SequenceNumber Value=\"{$msg[2]}\"/>\n";
                        $this->addEvent($msg[1], $msg, $timebase, $msg[2], 0);
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
                        $this->addEvent($msg[1], $msg, $timebase, $msg[2], 0);
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
                        $this->addEvent($msg[1], $msg, $timebase, intval($msg[2]), 0, $mode);
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
     * @param DOMDocument $domdoc
     * @param string $version
     * @return DOMNode
     */
    public function convertMidiToMusicXML($midi, $title, $domdoc, $version = "4.0") 
    {
        $timebase = $midi->getTimebase();
        $scorePartWise = new ScorePartWise();
        $scorePartWise->version = $version;
        $scorePartWise->identification = $this->getIdentification();
        $scorePartWise->partList = new PartList();
        $scorePartWise->partList->partGroupList = array();

        $this->buildPartList($midi);
        if (isset($this->copyright)) {
            $scorePartWise->identification->copyrights = $this->copyright;
        }

        $channelIdX  = array_column($this->partList, 'channelId');
        $programIdX = array_column($this->partList, 'programId');
        array_multisort($channelIdX, SORT_ASC, $programIdX, SORT_ASC, $this->partList);

        // begin part list
        $partIndex = 1;
        foreach ($this->partList as $part) {
            // start add score part
            // this block will be iterated each channel

            $partId = $part['partId'];
            $channelId = $part['channelId'];
            $partName = $part['instrument'][0];
            if ($partIndex == 1) {
                $partName = $title;
            }
            $partAbbreviation = $this->getPartAbbreviation($part);
            $instrumentName = $part['instrument'][0];
            $programId = $part['programId'];

            if ($channelId == 10) {
                $scorePart = $this->getScorePartChannel10($partId, $channelId, $programId, $partName, $partAbbreviation);
                $scorePartWise->partList->scorePartList[] = $scorePart;
            } else {
                if (isset($this->instrumentList[$programId - 1]) && isset($this->instrumentList[$programId - 1][2])) {
                    $instrumentSound = $this->instrumentList[$programId - 1][2];
                } else {
                    $this->getIsntrumentSound($channelId, $programId, $instrumentName);
                    $instrumentSound = strtolower(str_replace(' ', '.', $part['instrument'][0]));
                }
                $midiChannel = $part['channelId'];
                $midiProgramId = $part['programId'];
                $instrumentId = $part['instrumentId'];
                $volumeRaw = $this->getPartVolume($partId);
                $volume = $volumeRaw * 100 / 127;
                $volume = floatval(sprintf("%.4f", $volume));
                $panRaw = $this->getPartPan($partId);
                $pan = ($panRaw - 64) * 90 / 64;
                $scoreInstrument = $this->getScoreInstrument($instrumentId, $instrumentName, $instrumentSound);
                $midiInstrument = $this->getMidiInstrument($midiChannel, $instrumentId, $midiProgramId, $volume, $pan);
                $midiDevice = $this->getMidiDevice($instrumentId, $midiChannel);
                $scorePartWise->partList->scorePartList[] = $this->getScorePart($partId, $partName, $partAbbreviation, $scoreInstrument, $midiInstrument, $midiDevice);
            }
            // end add score part
            $partIndex++;
        }
        // end part list

        $scorePartWise->part = array();

        $this->processDuration();

        $factor = 4;
        $maxMeasure = floor($midi->getDurationRaw()/($factor * $timebase));

        // begin part

        foreach ($this->partList as $part) {
            $partId = $part['partId'];
            $channelId = $part['channelId'];
            $parts = new Part();
            $parts->id = $partId;
            $parts->measureList = array();
            for ($measureIndex = 0; $measureIndex < $maxMeasure; $measureIndex++) {
                $measure = $this->getMeasure($partId, $channelId, $measureIndex, $timebase);
                $parts->measureList[] = $measure;
            }
            $scorePartWise->part[] = $parts;
        }
        // end part

        return $scorePartWise->toXml($domdoc, self::SCORE_PARTWISE);
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

        

        $scorePart->partName = $partName;
        $scorePart->partAbbreviation = $partAbbreviation;
        ksort($this->channel10);
        foreach ($this->channel10 as $key => $value) 
        {
            $scoreInstrument = new ScoreInstrument();
            $midiInstrument = new MidiInstrument();
            $id = $partId . '-I' . $key;
            $scoreInstrument->id = $id; 
            $midiCode = $value['note'] - 1;
            if(isset($this->drumSet[$midiCode]) && isset($this->drumSet[$midiCode][0]))
            {
                $scoreInstrument->instrumentName = $this->drumSet[$midiCode][0];
            }
            else
            {
                $scoreInstrument->instrumentName = 'Instrument ' . $key;
            }
            $midiInstrument->id = $id;
            $midiInstrument->midiChannel = $channelId;
            $midiInstrument->midiProgram = $programId;
            $midiInstrument->midiUnpitched = $key;
            $midiInstrument->volume = isset($value['v']) ? (floatval(sprintf("%.4f", ($value['v'] * 100 / 127)))) : 0;
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
                $bpm = (int)(60000000/$tempo);
                $tempoList[$time] = array('rawtime'=>$rawtime, 'tempo'=>$tempo, 'bpm'=>$bpm);
            }
            if($message['event'] == 'KeySig')
            {
                $keySignatureList[$time] = array('fifths'=>$message['fifths'], 'mode'=>$message['mode']);
            }
        }
        $midiEvent = new MidiEvent();
        $midiEvent->tempoList = $tempoList;
        $midiEvent->keySignatureList = $keySignatureList;
        return $midiEvent;
    }
    
    private function getDirections($tempoList)
    {
        $lastBpm = 0;
        $directions = array();
        if(isset($tempoList))
        {
            foreach($tempoList as $value) 
            {
                $rawtime = $value['rawtime'];
                $bpm = $value['bpm'];
                if(!isset($directions[$rawtime]))
                {
                    $directions[$rawtime] = new Direction();
                }
                if($bpm != $lastBpm)
                {
                    $sound = new Sound();
                    $sound->tempo = $bpm;
                    $directions[$rawtime]->sound = $sound;
                    
                    $directionType = new DirectionType();
                    $metronome = new Metronome();
                    $metronome->parentheses = 'no';
                    $metronome->perMinute = $bpm;
                    $metronome->beatUnit = 'quarter';
                    $directionType->metronome = $metronome;
                    
                    $directions[$rawtime]->directionType = $directionType;
                    $directions[$rawtime]->placement = 'above';
                    
                    
                    $lastBpm = $bpm;
                }
            }
        }
        return $directions;
    }
    
    /**
     * Get measure
     *
     * @param string $partId
     * @param integer $channelId
     * @param integer $measureIndex
     * @return Measure
     */
    private function getMeasure($partId, $channelId, $measureIndex, $timebase)
    {
        $measure = new Measure();
        $measure->number = $measureIndex+1;
        
        if ($this->hasMessage(0, $measureIndex))
        {
            $midiEventMessages = $this->measures[0][$measureIndex];
            
            // events whithout channel information
            $controlEvents0 = $this->getControlEvent($midiEventMessages);
            $midiEvent = $this->getEventList($controlEvents0);
            $tempoList = $midiEvent->tempoList;
            $keySignatureList = $midiEvent->keySignatureList;


            if(!empty($tempoList))
            {
                $directions = $this->getDirections($tempoList);
                if(!empty($directions))
                {
                    $measure->direction = $directions;
                }
            } 
            if(!empty($keySignatureList))
            {
                $attributes = new Attributes();
                $attributes->key = array();
                $measure->attributesList = $this->initializeArray($measure->attributesList);
                foreach($keySignatureList as $keySignature)
                {
                    $attributes->key[] = $this->getKey($keySignature['fifths'], $keySignature['mode']);
                }
                $measure->attributesList[] = $attributes;
            }       
        }
        if ($this->hasMessage($channelId, $measureIndex)) {
            $midiEventMessages = $this->measures[$channelId][$measureIndex];
            $controlEvents = $this->getControlEvent($midiEventMessages);
            if (!empty($controlEvents)) 
            {
                foreach ($controlEvents as $message) 
                {
                    // do it here
                }
            }

            // begin add attribute
            $measure->attributesList = $this->initializeArray($measure->attributesList);
            $attributes = new Attributes();
            $attributes->divisions = 1;         
            $attributes->time = $this->getTime($this->timeSignature);
            $attributes->staves = 2;
            $attributes->clef = array();
            $clef1 = new Clef();
            $clef1->number = 1;
            $clef1->sign = 'G';
            $clef1->line = 2;
            $attributes->clef[] = $clef1;
            $clef2 = new Clef();
            $clef2->number = 2;
            $clef2->sign = 'G';
            $clef2->line = 2;
            $attributes->clef[] = $clef2;
            $measure->attributesList[] = $attributes ;
            // end add attribute
            
            
            
            // begin add note
            $noteMessages = $this->getNotes($midiEventMessages);
            if(!empty($noteMessages))
            {
                $measure->noteList = $this->initializeArray($measure->noteList);
                foreach ($noteMessages as $message) {

                    $duration = $message['duration'] * $timebase;
                    if($duration == 0)
                    {
                        $duration = 1;
                    }

                    $pitch = $this->getPitch($message['note']);
                    $note = new Note();
                    $note->pitch = $pitch;
                    $note->staff = $channelId;
                    $note->dynamics = $message['value'];
                    $note->duration = $duration;
                    $measure->noteList[] = $note;
                }
            }
            // end add note
            
        } 
        else 
        {
            $measure->attributesList = $this->initializeArray($measure->attributesList);
            $attributes = new Attributes();
            $attributes->divisions = 1;
            $measure->attributesList[] = $attributes ;
        }
        return $measure;
    }
    
    /**
     * Initialize array
     *
     * @param array|null
     * @return array
     */
    private function initializeArray($initialValue)
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
    protected function getTime($timeSignature)
    {
        $time = new Time();
        $time->beats = $timeSignature->beats;
        $time->beatType = $timeSignature->beatType;
        return $time;
    }
    
    /**
     * Get key
     *
     * @param integer $fifths
     * @param integer $mode
     * @return Key
     */
    protected function getKey($fifths, $mode)
    {
        $key = new Key();
        $key->fifths = $fifths;
        $key->mode = $mode;
        return $key;
    }

    /**
     * Create Music XML manualy
     *
     * @param DOMDocument $domdoc
     * @param string $version
     * @return DOMDocument
     */
    public function getMusicXml($domdoc, $version = "4.0")
    {
        $scorePartWise = new ScorePartWise();
        $scorePartWise->version = $version;
        $scorePartWise->setIdentification($this->getIdentification());
        $scorePartWise->partList = new PartList();
        $scorePartWise->partList->partGroupList = array();

        // start add score part
        // this block will be iterated each channel
        $partId = "P1";
        $partName = "Cinta Pertama dan Terakhir";
        $partAbbreviation = "Pno.";

        $instrumentName = "Piano";
        $instrumentSound = "keyboard.piano";

        $midiChannel = 1;
        $midiProgramId = 1;
        $instrumentId = 'P1-I1';

        $volume = 78.7402;
        $pan = 0;

        $scoreInstrument = $this->getScoreInstrument($instrumentId, $instrumentName, $instrumentSound);
        $midiInstrument = $this->getMidiInstrument($midiChannel, $instrumentId, $midiProgramId, $volume, $pan);
        $midiDevice = $this->getMidiDevice($instrumentId, $midiChannel);

        $scorePartWise->partList->scorePartList[] = $this->getScorePart($partId, $partName, $partAbbreviation, $scoreInstrument, $midiInstrument, $midiDevice);
        // end add score part

        $scorePartWise->part = array();

        $part = new Part();
        $part->id = "P1";
        $part->measureList = array();

        $measure = new Measure();
        $measure->number = 1;

        $measure->attributesList = array();

        $key = new Key();
        $key->fifths = 1;

        $time = new Time();
        $time->beats = 3;
        $time->beatType = 4;

        $clef = new Clef();
        $clef->sign = "F";
        $clef->line = 4;

        $transpose = new Transpose();
        $transpose->diatonic = 0;
        $transpose->chromatic = 0;
        $transpose->octaveChange = 0;

        $attributes = new Attributes();
        $attributes->divisions = 1;
        $attributes->staves = 1;
        $attributes->key = $key;
        $attributes->time = $time;
        $attributes->clef = $clef;
        $attributes->transpose = $transpose;

        $measure->attributesList[] = $attributes;

        $part->measureList[] = $measure;

        $scorePartWise->part[] = $part;

        return $scorePartWise->toXml($domdoc, self::SCORE_PARTWISE);
    }

    

    
}
