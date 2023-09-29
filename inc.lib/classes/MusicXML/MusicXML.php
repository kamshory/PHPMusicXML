<?php

namespace MusicXML;

use DateTime;
use DOMDocument;
use DOMNode;
use Midi\MidiMeasure;
use MusicXML\Model\Attributes;
use MusicXML\Model\Clef;
use MusicXML\Model\Key;
use MusicXML\Model\Measure;
use MusicXML\Model\MidiInstrument;
use MusicXML\Model\Note;
use MusicXML\Model\Part;
use MusicXML\Model\PartList;
use MusicXML\Model\ScoreInstrument;
use MusicXML\Model\ScorePart;
use MusicXML\Model\ScorePartWise;
use MusicXML\Model\Time;
use MusicXML\Model\Transpose;

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


    /**
     * Convert MIDI to MusicXML
     *
     * @param MidiMeasure $midi
     * @param string $version Version of MusicXML
     * @return string
     */
    public function midiToMusicXml($midi, $title, $version = "4.0")
    {
        $domdoc = $this->getDOMDocument();
        $domdoc->appendChild($this->convertMidiToMusicXML($midi, $title, $domdoc, $version));
        return $domdoc->saveXML();
    }

    private function processTime($msg, $timebase, $n, $ch, $v)
    {
        $tm = $msg[0] / (4 * $timebase);
        $tmInteger = floor($tm);
        if (!isset($this->measures[$ch])) {
            $this->measures[$ch] = array();
        }
        if (!isset($this->measures[$ch][$tmInteger])) {
            $this->measures[$ch][$tmInteger] = array();
        }
        $this->measures[$ch][$tmInteger][] = array('time' => $tm, 'channel' => $ch, 'note' => $n, 'velocity' => $v, 'event' => $msg[1], 'message' => $msg);
    }

    /**
     * Process duration
     *
     * @return void
     */
    private function processDuration()
    {
        $this->processDuration1();
        $this->processDuration2();
    }

    /**
     * Process duration
     *
     * @return void
     */
    private function processDuration1()
    {
        foreach ($this->measures as $ch => $chValue) {
            foreach ($chValue as $tmInteger => $tmIntegerValue) {
                foreach ($tmIntegerValue as $note => $noteValue) {

                    $chIdx = $noteValue['channel'];
                    $noteIdx = $noteValue['note'];
                    $index = "n" . $chIdx . "_" . $noteIdx;

                    if (isset($lastTime[$index])) {
                        $lt = $lastTime[$index];
                    } else {
                        $lt = 0;
                    }

                    $duration = $noteValue['time'] - $lt;
                    $this->measures[$ch][$tmInteger][$note]['duration'] = $duration;
                    $this->measures[$ch][$tmInteger][$note]['last'] = $lt;

                    $lastTime[$index] = $noteValue['time'];
                }
            }
        }
    }

    /**
     * Process duration
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
     * Set note duration
     *
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



    /**
     * Build part list
     *
     * @param MidiMeasure $midi
     * @return void
     */
    private function buildPartList($midi) // NOSONAR
    {
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
                        $this->partList[$instrumentId] = array('instrumentId' => $instrumentId, 'channelId' => $ch, 'partId' => $partId, 'programId' => $p1, 'instrument' => $instrument, 'port' => $ch);


                        $xml .= "<ProgramChange Channel=\"$ch\" Number=\"$p\"/>\n";
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
                        $this->processTime($msg, $midi->getTimebase(), $n, $ch, $v);


                        $xml .= "<Note{$msg[1]} Channel=\"$ch\" Note=\"$n\" Velocity=\"$v\"/>\n";
                        break;

                    case 'PoPr':
                        eval("\$" . $msg[2] . ';'); // $ch
                        eval("\$" . $msg[3] . ';'); // $n
                        eval("\$" . $msg[4] . ';'); // $v

                        $ch = isset($ch) ? $ch : 0;
                        $n = isset($n) ? $n : 0;
                        $v = isset($v) ? $v : 0;

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


                        $xml .= "<ControlChange Channel=\"$ch\" Control=\"$c\" Value=\"$v\"/>\n";
                        break;

                    case 'ChPr':
                        eval("\$" . $msg[2] . ';'); // ch
                        eval("\$" . $msg[3] . ';'); // v

                        $ch = isset($ch) ? $ch : 0;
                        $v = isset($v) ? $v : 0;

                        $xml .= "<ChannelKeyPressure Channel=\"$ch\" Pressure=\"$v\"/>\n";
                        break;

                    case 'Pb':
                        eval("\$" . $msg[2] . ';'); // ch
                        eval("\$" . $msg[3] . ';'); // v

                        $ch = isset($ch) ? $ch : 0;
                        $v = isset($v) ? $v : 0;

                        $xml .= "<PitchBendChange Channel=\"$ch\" Value=\"$v\"/>\n";
                        break;

                    case 'Seqnr':
                        $xml .= "<SequenceNumber Value=\"{$msg[2]}\"/>\n";
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
                        break;

                    case 'SMPTE':
                        $xml .= "<SMPTEOffset TimeCodeType=\"1\" Hour=\"{$msg[2]}\" Minute=\"{$msg[3]}\" Second=\"{$msg[4]}\" Frame=\"{$msg[5]}\" FractionalFrame=\"{$msg[6]}\"/>\n"; //TimeCodeType???
                        break;

                    case 'TimeSig': // LogDenum???
                        $ts = explode('/', $msg[2]);
                        $xml .= "<TimeSignature Numerator=\"{$ts[0]}\" LogDenominator=\"" . log($ts[1]) / log(2) . "\" MIDIClocksPerMetronomeClick=\"{$msg[3]}\" ThirtySecondsPer24Clocks=\"{$msg[4]}\"/>\n";
                        break;

                    case 'KeySig':
                        $mode = ($msg[3] == 'major') ? 0 : 1;
                        $xml .= "<KeySignature Fifths=\"{$msg[2]}\" Mode=\"$mode\"/>\n"; // ???
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
                $scorePart = $this->getScorePartChannel10($part, $partId, $channelId, $programId);
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

        $scorePartWise->parts = array();

        $this->processDuration();

        $factor = 4;
        $maxMeasure = floor($midi->getDurationRaw()/($factor * $midi->getTimebase()));

        // begin part
        foreach ($this->partList as $part) {
            $partId = $part['partId'];
            $channelId = $part['channelId'];
            $parts = new Part();
            $parts->id = $partId;
            $parts->measureList = array();
            for ($measureIndex = 1; $measureIndex <= $maxMeasure; $measureIndex++) {
                $measure = $this->getMeasure($channelId, $measureIndex);
                $parts->measureList[] = $measure;
            }
            $scorePartWise->parts[] = $parts;
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
    private function getScorePartChannel10($part, $partId, $channelId, $programId)
    {
        $scorePart = new ScorePart();
        $scorePart->scoreInstrument = array();
        $scorePart->midiInstrument = array();
        ksort($this->channel10);
        foreach ($this->channel10 as $key => $value) {
           
            echo "PROGRAM ID = $programId\r\n";
            $scoreInstrument = new ScoreInstrument();
            $midiInstrument = new MidiInstrument();
            $id = $partId . '-I' . $key;
            $scoreInstrument->id = $id;
  
            $midiCode = $value['note'] - 1;
            echo "MIDI CODE = $midiCode\r\n";

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
     * Get measure
     *
     * @param integer $channelId
     * @param integer $measureIndex
     * @return Measure
     */
    private function getMeasure($channelId, $measureIndex)
    {
        $measure = new Measure();
        $measure->number = $measureIndex;
        if ($this->hasMessage($channelId, $measureIndex)) {
            $midiEventMessages = $this->measures[$channelId][$measureIndex];
            $programChange = $this->getProgramChange($midiEventMessages);
            if (!empty($programChange)) {
                foreach ($programChange as $message) {
                    // do it here
                }
            }

            $measure->attributesList = array();
            $attribute = new Attributes();
            $attribute->divisions = 1;

            $key = new Key();
            $key->fifths = 3;
            $attribute->key = $key;

            $time = new Time();
            $time->beats = 3;
            $time->beatType = 4;
            $attribute->time = $time;

            $attribute->staves = 2;

            $attribute->clef = array();
            $clef1 = new Clef();
            $clef1->number = 1;
            $clef1->sign = 'G';
            $clef1->line = 2;
            $attribute->clef[] = $clef1;
            $clef2 = new Clef();
            $clef2->number = 2;
            $clef2->sign = 'G';
            $clef2->line = 2;
            $attribute->clef[] = $clef2;

            $measure->attributesList[] = $attribute;

            $noteMessages = $this->getNotes($midiEventMessages);
            foreach ($noteMessages as $message) {
                if ($message['note'] > 17) {
                    // audiable
                    $pitch = $this->getPitch($message['note']);
                    $measure->noteList = array();
                    $note = new Note();
                    $note->pitch = $pitch;
                    $measure->noteList[] = $note;
                }
            }
        } else {
            $measure->attributesList = array();
            $attribute = new Attributes();
            $attribute->divisions = 1;
            $measure->attributesList[] = $attribute;
        }
        return $measure;
    }

    /**
     * Undocumented function
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

        $scorePartWise->parts = array();

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

        $scorePartWise->parts[] = $part;

        return $scorePartWise->toXml($domdoc, self::SCORE_PARTWISE);
    }

    

    
}
