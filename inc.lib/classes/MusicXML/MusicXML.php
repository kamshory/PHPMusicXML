<?php

namespace MusicXML;

use DateTime;
use DOMNode;
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

class MusicXML
{
    /**
     * Get MusicXML
     *
     * @return DOMNode
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
    
    public function getIdentification()
    {
        $identification = new Identification();
        
        $identification->setCopyrights("Namira Jl.KH.Wahid Hasyim II No.44 Kediri Jawa Timur");
        
        $identification->encoding = new Encoding();
        $identification->encoding->encodingDate = new DateTime();
        $identification->encoding->softwareList = array();
        $identification->encoding->softwareList[] = new Software(array('description'=>'MuseScore 4.1.1'));       
        
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
        $scorePart->setScoreInstrument($scoreInstrument);
        $scorePart->setMidiInstrument($midiInstrument);
        $scorePart->setMidiDevice($midiDevice);
        return $scorePart;
    }
    
}