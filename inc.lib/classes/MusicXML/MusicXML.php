<?php

namespace MusicXML;

use DateTime;
use DOMDocument;
use DOMNode;
use Midi\MidiMeasure;
use MusicXML\Model\Attributes;
use MusicXML\Model\Clef;
use MusicXML\Model\Encoding;
use MusicXML\Model\Identification;
use MusicXML\Model\Key;
use MusicXML\Model\Measure;
use MusicXML\Model\MidiDevice;
use MusicXML\Model\MidiInstrument;
use MusicXML\Model\Part;
use MusicXML\Model\PartList;
use MusicXML\Model\ScoreInstrument;
use MusicXML\Model\ScorePart;
use MusicXML\Model\ScorePartWise;
use MusicXML\Model\Software;
use MusicXML\Model\Supports;
use MusicXML\Model\Time;
use MusicXML\Model\Transpose;

class MusicXML extends MusicXMLBase
{
    const SCORE_PARTWISE = "score-partwise";
    const SOFTWARE_NAME = "Planetbiru";
    public function loadMidi($midiPath)
    {
        $midi = new MidiMeasure();
        $midi->importMid($midiPath);
        return $midi;
    }
    
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

    private $partList = array();
    private $partVolume = array();
    private $partPan = array();

    private $measures = array();

    private function processTime($msg, $timebase, $n, $ch, $v)
    {
        $tm = $msg[0] / 4 * $timebase;
        $tmInteger = floor($tm);
        $tmDec = $tm - $tmInteger;

        if(!isset($this->measures[$ch]))
        {
            $this->measures[$ch] = array();
        }
        if(!isset($this->measures[$ch][$tmInteger]))
        {
            $this->measures[$ch][$tmInteger] = array();
        }
        $this->measures[$ch][$tmInteger][] = array('time'=>$tm, 'channel'=>$ch, 'note'=>$n, 'velocity'=>$v, 'event'=>$msg[1], 'message'=>$msg);
    }
    private function processDuration()
    {
        $lastTime = array();
        $lastIndex = array();
        foreach($this->measures as $ch=>$chValue)
        {
            foreach($chValue as $tmInteger=>$tmIntegerValue)
            {
                foreach($tmIntegerValue as $note=>$noteValue)
                {
 
                    $chIdx = $noteValue['channel'];
                    $noteIdx = $noteValue['note'];
                    $index = "n".$chIdx."_".$noteIdx;

                    if(isset($lastTime[$index]))
                    {
                        $lt = $lastTime[$index];
                    }
                    else
                    {
                        $lt = 0;
                    }

                    $duration = $noteValue['time'] - $lt;
                    $this->measures[$ch][$tmInteger][$note]['duration'] = $duration;
                    $this->measures[$ch][$tmInteger][$note]['last'] = $lt;
 
                    $lastTime[$index] = $noteValue['time'];
                    if($ch == 1)
                    {
                        //echo $index." $tmInteger $lt \r\n";
                    }

                    
                }
                
            }
        }
        foreach($this->measures as $ch=>$chValue)
        {
            foreach($chValue as $tmInteger=>$tmIntegerValue)
            {
                foreach($tmIntegerValue as $note=>$noteValue)
                {
                    if(isset($this->measures[$ch][$tmInteger][$note]['time']) && isset($this->measures[$ch][$tmInteger][$note]['last']))
                    {
                        $this->measures[$ch][$tmInteger][$note]['duration'] = $this->measures[$ch][$tmInteger][$note]['time'] - $this->measures[$ch][$tmInteger][$note]['last'];
                    }
                    
                }
            }
        }
        
    }

    public function setNoteDuration($ch, $indexOn, $duration)
    {

        $x = $this->measures[$ch][$indexOn];
        $lastOn = $this->findLastOn($x);
        $this->measures[$ch][$indexOn][$lastOn]['duration'] = $duration;
    }
    public function findLastOn($x)
    {
        $last = 0;
        foreach($x as $idx=>$note)
        {
            if($note['event'] == 'On')
            {
                $last = $idx;
            }
        }
        return $last;
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
            
        $scorePartWise->setIdentification($this->getIdentification());        
        
        $scorePartWise->partList = new PartList();
        $scorePartWise->partList->partGroupList = array();     
        
        $tracks = $midi->getTracks();
        $tc = count($tracks);
        $type = ($tc>1)?1:0;
        $timebase = $midi->getTimebase();

        $xml = "";
        $ttype = 0;

        $instrumentList = $midi->getInstrumentList();
        $drumSet = $midi->getDrumset();

        $channel10 = array();
        
        
        for ($i=0; $i<$tc; $i++)
        {
            $xml .= "<Track Number=\"$i\">\n";
            $track = $tracks[$i];
            $mc = count($track);
            $last = 0;
            for ($j=0;$j<$mc;$j++){
                $msg = explode(' ',$track[$j]);
                $t = (int) $msg[0];
                if ($ttype==1){//delta
                    $dt = $t - $last;
                    $last = $t;
                }
                $xml .= "  <Event>\n";
                $xml .= ($ttype==1)?"    <Delta>$dt</Delta>\n":"    <Absolute>$t</Absolute>\n";
                $xml .= '    ';
        
                    switch($msg[1]){
                        case 'PrCh':
                            eval("\$".$msg[2].';'); // $ch
                            eval("\$".$msg[3].';'); // $p
                            $ch = isset($ch) ? $ch : 0;
                            $p = isset($p) ? $p : 0;

                            $instrument = $this->getInstrumentName($p, $ch);
             
                            $partId = "P".$ch;
                            $p1 = $p + 1;
                            $instrumentId = $ch == 10 ? "P".$ch."-I".$p1 : "P".$ch."-I1";
                            $this->partList[$instrumentId] = array('instrumentId'=>$instrumentId, 'channelId'=>$ch, 'partId'=>$partId, 'channelId'=>$ch, 'programId'=>$p1, 'instrument'=>$instrument, 'port'=>$ch);

                           
                        $xml .= "<ProgramChange Channel=\"$ch\" Number=\"$p\"/>\n";
                            break;
        
                        case 'On':
                        case 'Off':
                            eval("\$".$msg[2].';'); // $ch
                            eval("\$".$msg[3].';'); // $n
                            eval("\$".$msg[4].';'); // $v
                            eval("\$".$msg[5].';'); // $dt
                            
                            $ch = isset($ch) ? $ch : 0;
                            $n = isset($n) ? $n : 0;
                            $v = isset($v) ? $v : 0;
                            $dt = isset($dt) ? $dt : 0;
                            if($ch == 10 && !isset($channel10[$n+1]))
                            {
                                $channel10[$n+1] = array('note'=>$n+1, 'ch'=>$ch, 'n'=>$n, 'v'=>$v, 'message'=>$msg);
                            }
                            $this->processTime($msg, $midi->getTimebase(), $n, $ch, $v);
                            
                            
                        $xml .= "<Note{$msg[1]} Channel=\"$ch\" Note=\"$n\" Velocity=\"$v\"/>\n";
                            break;
        
                        case 'PoPr':
                            eval("\$".$msg[2].';'); // $ch
                            eval("\$".$msg[3].';'); // $n
                            eval("\$".$msg[4].';'); // $v
                            
                            $ch = isset($ch) ? $ch : 0;
                            $n = isset($n) ? $n : 0;
                            $v = isset($v) ? $v : 0;
                            
                            $xml .= "<PolyKeyPressure Channel=\"$ch\" Note=\"$n\" Pressure=\"$v\"/>\n";
                            break;
        
                        case 'Par':
                            eval("\$".$msg[2].';'); // ch
                            eval("\$".$msg[3].';'); // c
                            eval("\$".$msg[4].';'); // v
                            
                            $ch = isset($ch) ? $ch : 0;
                            $c = isset($c) ? $c : 0;
                            $v = isset($v) ? $v : 0;

                            $partId = "P".$ch;
                            if($c == 7 && (!isset($this->partVolume[$partId])))
                            {
                                $this->partVolume[$partId] = $v;
                            }
                            if($c == 10 && (!isset($this->partPan[$partId]) || $this->partPan[$partId] == 0))
                            {
                                $this->partPan[$partId] = $v;
                            }
                            
                            
                            $xml .= "<ControlChange Channel=\"$ch\" Control=\"$c\" Value=\"$v\"/>\n";
                            break;
        
                        case 'ChPr':
                            eval("\$".$msg[2].';'); // ch
                            eval("\$".$msg[3].';'); // v
                            
                            $ch = isset($ch) ? $ch : 0;
                            $v = isset($v) ? $v : 0;
                            
                            $xml .= "<ChannelKeyPressure Channel=\"$ch\" Pressure=\"$v\"/>\n";
                            break;
        
                        case 'Pb':
                            eval("\$".$msg[2].';'); // ch
                            eval("\$".$msg[3].';'); // v
                            
                            $ch = isset($ch) ? $ch : 0;
                            $v = isset($v) ? $v : 0;
                            
                            $xml .= "<PitchBendChange Channel=\"$ch\" Value=\"$v\"/>\n";
                            break;
        
                        case 'Seqnr':
                            $xml .= "<SequenceNumber Value=\"{$msg[2]}\"/>\n";
                            break;
        
                        case 'Meta':
                            $txttypes = array('Text','Copyright','TrkName','InstrName','Lyric','Marker','Cue');
                            $mtype = $msg[2];
        
                            $pos = array_search($mtype, $txttypes);
                            if ($pos !== false)
                            {
                                $tags = array('TextEvent','CopyrightNotice','TrackName','InstrumentName','Lyric','Marker','CuePoint');
                                $tag = $tags[$pos];
                                $line = $track[$j];
                                $start = strpos($line,'"')+1;
                                $end = strrpos($line,'"');
                                $txt = substr($line,$start,$end-$start);
                                $xml .= "<$tag>".htmlspecialchars($txt)."</$tag>\n";
                                
                                if($tag == 'CopyrightNotice')
                                {
                                    $scorePartWise->identification->copyrights = $txt;
                                }
                                
                            }
                            else
                            {
                                if ($mtype == 'TrkEnd')
                                {$xml .= "<EndOfTrack/>\n";}
                                else if ($mtype == '0x20' || $mtype == '0x21') // ChannelPrefix ???
                                {$xml .= "<MIDIChannelPrefix Value=\"{$msg[3]}\"/>\n";}
                            }
                            break;
        
                        case 'Tempo':
                            $xml .= "<SetTempo Value=\"{$msg[2]}\"/>\n";
                            break;
        
                        case 'SMPTE':
                            $xml .= "<SMPTEOffset TimeCodeType=\"1\" Hour=\"{$msg[2]}\" Minute=\"{$msg[3]}\" Second=\"{$msg[4]}\" Frame=\"{$msg[5]}\" FractionalFrame=\"{$msg[6]}\"/>\n"; //TimeCodeType???
                            break;
        
                        case 'TimeSig': // LogDenum???
                            $ts = explode('/',$msg[2]);
                        $xml .= "<TimeSignature Numerator=\"{$ts[0]}\" LogDenominator=\"".log($ts[1])/log(2)."\" MIDIClocksPerMetronomeClick=\"{$msg[3]}\" ThirtySecondsPer24Clocks=\"{$msg[4]}\"/>\n";
                            break;
        
                        case 'KeySig':
                            $mode = ($msg[3]=='major')?0:1;
                            $xml .= "<KeySignature Fifths=\"{$msg[2]}\" Mode=\"$mode\"/>\n"; // ???
                            break;
        
                        case 'SeqSpec':
                            $line = $track[$j];
                            $start = strpos($line,'SeqSpec')+8;
                            $data = substr($line,$start);
                            $xml .= "<SequencerSpecific>$data</SequencerSpecific>\n";
                            break;
        
                        case 'SysEx':
                            $str = '';
                            for ($k=3;$k<count($msg);$k++) 
                            {
                                $str .= $msg[$k].' ';
                            }
                            $str = trim(strtoupper($str));
                            $xml .= "<SystemExclusive>$str</SystemExclusive>\n";
                            break;
        /* 
        <AllSoundOff Channel="9"/>
        <ResetAllControllers Channel="9"/>
        <LocalControl Channel="9" Value="on"/>
        <AllNotesOff Channel="9"/>
        <OmniOff Channel="9"/>
        <OmniOn Channel="9"/>
        <MonoMode Channel="9" Value="5"/>
        <PolyMode Channel="9"/>
        */
                        default:
                           
                    }
                    $xml .= "  </Event>\n";
            }
            $xml .= "</Track>\n";
          }
          $xml .= "</MIDIFile>";
 

        $channelIdX  = array_column($this->partList, 'channelId');
        $programIdX = array_column($this->partList, 'programId');
        array_multisort($channelIdX, SORT_ASC, $programIdX, SORT_ASC, $this->partList);



        // begin part list
        foreach($this->partList as $part)
        {
            // start add score part
            // this block will be iterated each channel

            $partId = $part['partId'];
 
            $channelId = $part['channelId'];
            $partName = $part['instrument'][0];
            if($partId == "P1")
            {
                $partName = $title;
            }
            $partAbbreviation = isset($part['instrument'][1]) ? $part['instrument'][1] : $part['instrument'][0];
            $instrumentName = $part['instrument'][0];
            $programId = $part['programId'];

            if($channelId == 10)
            {
                $scorePart = new ScorePart();
                $scorePart->scoreInstrument = array();
                $scorePart->midiInstrument = array();
                ksort($channel10);
                foreach($channel10 as $key=>$value)
                {
                    $scoreInstrument = new ScoreInstrument();
                    $midiInstrument = new MidiInstrument();

                    $id = $partId.'-I'.$key;
                    $scoreInstrument->id = $id;
                    $scoreInstrument->instrumentName = 'Instrument '.$key;

                    $midiInstrument->id = $id;
                    $midiInstrument->midiChannel = $channelId;
                    $midiInstrument->midiProgram = $programId;
                    $midiInstrument->midiUnpitched = $key;
                    $midiInstrument->volume = isset($value['v']) ? (floatval(sprintf("%.4f", ($value['v'] * 100 / 127)))) : 0;

                    $scorePart->scoreInstrument[] = $scoreInstrument;
                    $scorePart->midiInstrument[] = $midiInstrument;
                }

                $scorePartWise->partList->scorePartList[] = $scorePart;
            }
            else
            {
                if(isset($this->instrumentList[$programId-1]) && isset($this->instrumentList[$programId-1][2]))
                {
                    $instrumentSound = $this->instrumentList[$programId-1][2];
                }
                else
                {
                    $this->getIsntrumentSound($channelId, $programId, $instrumentName);
                    $instrumentSound = strtolower(str_replace(' ', '.', $part['instrument'][0]));
                }

                $midiChannel = $part['channelId'];
                $midiProgramId = $part['programId'];
                $instrumentId = $part['instrumentId'];
                
                $volumeRaw = isset($this->partVolume[$partId]) ? $this->partVolume[$partId] : 0;
                $volume = $volumeRaw * 100 / 127;
                $volume = (float) sprintf("%.4f", $volume);
                $panRaw = isset($this->partPan[$partId]) ? $this->partPan[$partId] : 0;
                $pan = ($panRaw - 64) * 90 / 64;
                
                

                $scoreInstrument = $this->getScoreInstrument($instrumentId, $instrumentName, $instrumentSound);
                $midiInstrument = $this->getMidiInstrument($midiChannel, $instrumentId, $midiProgramId, $volume, $pan);
                $midiDevice = $this->getMidiDevice($instrumentId, $midiChannel);
                
                $scorePartWise->partList->scorePartList[] = $this->getScorePart($partId, $partName, $partAbbreviation, $scoreInstrument, $midiInstrument, $midiDevice);
            }
            // end add score part
        }
        // end part list

        $scorePartWise->parts = array();

        $this->processDuration();

        //print_r($this->measures[1]);
        error_reporting(0);

        $lastTime = 0;
        foreach($this->measures as $ch=>$msrs)
        {
            $val = end($msrs);
            $end = end($val);
            if(is_array($end))
            {
                
                $curLastTime = $end['time'] + (isset($end['duration']) ? $end['duration'] : 0);
                if($curLastTime > $lastTime)
                {
                    $lastTime = $curLastTime;
                }
            }
        }
        $maxMeasure = ceil($lastTime);

        // begin part
        //print_r($this->measures);
        foreach($this->partList as $pid=>$part)
        {
            $partId = $part['partId'];
            $channelId = $part['channelId'];

            $parts = new Part();
            $parts->id = $partId;

            $parts->measureList = array();

            for($msr = 1; $msr <= $maxMeasure; $msr++)
            {
                $measure = new Measure();
                $measure->number = $msr;

                if(isset($this->measures[$channelId]) && isset($this->measures[$channelId][$msr]))
                {
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
                }
                else
                {
                    
                }

                $parts->measureList[] = $measure;
            }

            $scorePartWise->parts[] = $parts;
        }
        // end part
          
        return $scorePartWise->toXml($domdoc, self::SCORE_PARTWISE);
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
        $measure->setNumber(1);
        
        $measure->attributesList = array();
        
        $key = new Key();
        $key->fifths = "1";
        
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
        
        
        return $scorePartWise->toXml($domdoc, "score-partwise");
    }
    
    public function getIdentification($copyright = "")
    {
        $identification = new Identification();
        
        $identification->setCopyrights($copyright);
        
        $identification->encoding = new Encoding();
        $identification->encoding->encodingDate = new DateTime();
        $identification->encoding->softwareList = array();
        
        $software = new Software();
        $software->setDescription(self::SOFTWARE_NAME);
        
        $identification->encoding->softwareList[] = $software;       
        
        $identification->encoding->supports[] = array();   
        $identification->encoding->supports[] = new Supports(array('element'=>'accidental', 'type'=>'yes'));
        $identification->encoding->supports[] = new Supports(array('element'=>'beam', 'type'=>'yes'));
        $identification->encoding->supports[] = new Supports(array('element'=>'print', 'attribute'=>'new-page', 'type'=>'no'));
        $identification->encoding->supports[] = new Supports(array('element'=>'print', 'attribute'=>'new-system', 'type'=>'no'));
        $identification->encoding->supports[] = new Supports(array('element'=>'stem', 'type'=>'yes'));
        
        return $identification;
    }
    
    private function getMidiDevice($midiId, $port)
    {
        $midiDevice = new MidiDevice();
        $midiDevice->setId($midiId);
        $midiDevice->setPort($port);
        return $midiDevice;
    }
    
    /**
     * Get score instrument
     *
     * @return ScoreInstrument
     */
    private function getScoreInstrument($instrumentId, $instrumentName, $instrumentSound)
    {
        $scoreInstrument = new ScoreInstrument();     
        $scoreInstrument->setId($instrumentId);
        $scoreInstrument->setInstrumentName($instrumentName);
        $scoreInstrument->setInstrumentSound($instrumentSound);     
        return $scoreInstrument;
    }
    
    /**
     * Get score instrument
     *
     * @return MidiInstrument
     */
    private function getMidiInstrument($midiChannel, $instrumentId, $midiProgramId, $volume = 100, $pan = 0)
    {
        $midiInstrument = new MidiInstrument();
        $midiInstrument->setId($instrumentId);
        $midiInstrument->setMidiChannel($midiChannel);
        $midiInstrument->setMidiProgram($midiProgramId);
        $midiInstrument->setVolume($volume);
        $midiInstrument->setPan($pan);         
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
     * @return ScorePart
     */
    public function getScorePart($partId, $partName, $partAbbreviation, $scoreInstrument, $midiInstrument, $midiDevice) //NOSONAR
    {
        $scorePart = new ScorePart();
        $scorePart->setId($partId);
        $scorePart->setPartName($partName);
        $scorePart->setPartAbbreviation($partAbbreviation);
        $scorePart->scoreInstrument = array();
        $scorePart->scoreInstrument[] = $scoreInstrument;
        $scorePart->midiInstrument = array();
        $scorePart->midiInstrument[] = $midiInstrument;
        $scorePart->setMidiDevice($midiDevice);
        return $scorePart;
    }
    
}