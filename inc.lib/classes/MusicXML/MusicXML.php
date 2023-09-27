<?php

namespace MusicXML;

use DateTime;
use DOMNode;
use MusicXML\Model\Encoding;
use MusicXML\Model\Identification;
use MusicXML\Model\InstrumentName;
use MusicXML\Model\InstrumentSound;
use MusicXML\Model\MidiDevice;
use MusicXML\Model\MidiInstrument;
use MusicXML\Model\PartList;
use MusicXML\Model\ScoreInstrument;
use MusicXML\Model\ScorePart;
use MusicXML\Model\ScorePartWise;
use MusicXML\Model\Software;
use MusicXML\Model\Supports;

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
    
    /**
     * Get score part
     *
     * @return ScorePart
     */
    public function getScorePart2()
    {
        $scorePart = new ScorePart();
        $scorePart->setId('P2');
        $scorePart->setPartName('Cinta Pertama dan Terakhir');
        $scorePart->setPartAbbreviation('Pno.');
        
        $scoreInstrument = new ScoreInstrument();
        
        $scoreInstrument->setId('P2-I1');
        $scoreInstrument->setInstrumentName('Piano');
        $scoreInstrument->setInstrumentSound('keyboard.piano');     
        
        $midiInstrument = new MidiInstrument();
        
        $midiInstrument->setId('P2-I1');
        $midiInstrument->setMidiChannel(1);
        $midiInstrument->setMidiProgram(1);
        $midiInstrument->setVolume(78.7402);
        $midiInstrument->setPan(0);
        
        $scorePart->scoreInstrument = $scoreInstrument;
        
        $scorePart->midiInstrument = $midiInstrument;
        
        return $scorePart;
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
    
    /**
     * Get score part
     *
     * @return ScorePart
     */
    public function getScorePart1()
    {
        $scorePart = new ScorePart();
        $scorePart->setId('P1');
        $scorePart->setPartName('Cinta Pertama dan Terakhir');
        $scorePart->setPartAbbreviation('Pno.');
        
        $scoreInstrument = new ScoreInstrument();
        
        $scoreInstrument->setId('P1-I1');
        $scoreInstrument->setInstrumentName('Piano');
        $scoreInstrument->setInstrumentSound('keyboard.piano');     
        
        $midiInstrument = new MidiInstrument();
        
        $midiInstrument->setId('P1-I1');
        $midiInstrument->setMidiChannel(1);
        $midiInstrument->setMidiProgram(1);
        $midiInstrument->setVolume(78.7402);
        $midiInstrument->setPan(0);
        
        $scorePart->scoreInstrument = $scoreInstrument;
        
        $scorePart->midiInstrument = $midiInstrument;
        
        return $scorePart;
    }
}