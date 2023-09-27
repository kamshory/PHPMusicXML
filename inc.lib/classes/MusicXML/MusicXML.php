<?php

namespace MusicXML;

use DateTime;
use DOMNode;
use MusicXML\Model\Encoding;
use MusicXML\Model\Identification;
use MusicXML\Model\InstrumentName;
use MusicXML\Model\InstrumentSound;
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
        
        
        $scorePartWise->partList->scorePartList[] = $this->getScorePart();
        $scorePartWise->partList->scorePartList[] = new ScorePart();
        $scorePartWise->partList->scorePartList[] = new ScorePart();
        $scorePartWise->partList->scorePartList[] = new ScorePart();
        $scorePartWise->partList->scorePartList[] = new ScorePart();
                
        
        return $scorePartWise->toXml($domdoc, "score-partwise");
    }
    
    public function getIdentification()
    {
        $identification = new Identification();
        
        $identification->setCreator("Kamshory");
        $identification->setCreatorType("software");
        $identification->setCopyright("Namira Jl.KH.Wahid Hasyim II No.44 Kediri Jawa Timur");
        
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
    public function getScorePart()
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