<?php

namespace MusicXML\Properties;

class MidiEvent 
{
    private $tempoList = array();
    private $keySignatureList = array();

    /**
     * Constructor
     *
     * @param array $tempoList
     * @param array $keySignatureList
     */
    public function __construct($tempoList, $keySignatureList)
    {
        $this->setTempoList($tempoList);
        $this->setKeySignatureList($keySignatureList);
    }

    /**
     * Get the value of tempoList
     */ 
    public function getTempoList()
    {
        return $this->tempoList;
    }

    /**
     * Set the value of tempoList
     *
     * @return  self
     */ 
    public function setTempoList($tempoList)
    {
        $this->tempoList = $tempoList;

        return $this;
    }

    /**
     * Get the value of keySignatureList
     */ 
    public function getKeySignatureList()
    {
        return $this->keySignatureList;
    }

    /**
     * Set the value of keySignatureList
     *
     * @return  self
     */ 
    public function setKeySignatureList($keySignatureList)
    {
        $this->keySignatureList = $keySignatureList;

        return $this;
    }
}