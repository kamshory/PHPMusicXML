<?php

namespace MusicXML\Properties;

class AttackRelease
{
    /**
     * Attack
     *
     * @var integer
     */
    private $attack = 0;
    
    /**
     * Release
     *
     * @var integer
     */
    private $release = 0;
    
    public function __construct($attack, $release)
    {
        $this->attack = round($attack);
        $this->release = round($release);
    }

    

    /**
     * Get attack
     *
     * @return  integer
     */ 
    public function getAttack()
    {
        return $this->attack;
    }

    /**
     * Set attack
     *
     * @param  integer  $attack  Attack
     *
     * @return  self
     */ 
    public function setAttack($attack)
    {
        $this->attack = $attack;

        return $this;
    }

    /**
     * Get release
     *
     * @return  integer
     */ 
    public function getRelease()
    {
        return $this->release;
    }

    /**
     * Set release
     *
     * @param  integer  $release  Release
     *
     * @return  self
     */ 
    public function setRelease($release)
    {
        $this->release = $release;

        return $this;
    }
}