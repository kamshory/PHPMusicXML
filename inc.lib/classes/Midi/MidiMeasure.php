<?php

namespace Midi;

use stdClass;

/**
 * Class MidiMeasure
 */
class MidiMeasure extends Midi
{
    /**
     * Get duration
     *
     * @return float
     */
    public function getDurationRaw()
    {
        $duration = 0;
        $t = 0;
        $track = $this->tracks[0];
 
        foreach ($this->tracks as $trk) {
            $mc = count($trk);
            for ($i = 0; $i < $mc; $i++) {
                $msg = explode(' ', $trk[$i]);
                if (@$msg[1] == 'Tempo') {
                    $dt = (int)$msg[0] - $t;
                    $duration += $dt;
                    $t = (int)$msg[0];
                }
            }
        }
        # find last event in all tracks
        $end_time = $t;
        foreach ($this->tracks as $track) {
            $msg = explode(' ', $track[count($track) - 1]);
            $end_time = max($end_time, (int)$msg[0]);
        }
        if ($end_time > $t) {
            $dt = $end_time - $t;
            $duration += $dt;
        }
        return $duration;
    }

    /**
     * Get duration
     *
     * @return float
     */
    public function getDuration()
    {
        $duration = 0;
        $currentTempo = 0;
        $t = 0;
        $track = $this->tracks[0];
        $f = 1 / $this->getTimebase() / 1000000;

        foreach ($this->tracks as $trk) {
            $mc = count($trk);
            for ($i = 0; $i < $mc; $i++) {
                $msg = explode(' ', $trk[$i]);
                if (@$msg[1] == 'Tempo') {
                    $dt = (int)$msg[0] - $t;
                    $duration += $dt * $currentTempo * $f;
                    $t = (int)$msg[0];
                    $currentTempo = (int)$msg[2];
                }
            }
        }
        # find last event in all tracks
        $end_time = $t;
        foreach ($this->tracks as $track) {
            $msg = explode(' ', $track[count($track) - 1]);
            $end_time = max($end_time, (int)$msg[0]);
        }
        if ($end_time > $t) {
            $dt = $end_time - $t;
            $duration += $dt * $currentTempo * $f;
        }
        return $duration;
    }

    /**
     * Get tempo information
     *
     * @param integer $tempo
     * @param float $start
     * @param float $end
     * @return stdClass
     */
    private function getTempoEvent($tempo, $start, $end)
    {
        $tempoEvent = new stdClass;
        $tempoEvent->timeBase = $this->getTimebase();
        $tempoEvent->tempo = $tempo;
        $tempoEvent->bpm = 60000000 / $tempo;
        $tempoEvent->start = $start;
        $tempoEvent->end = $end;
        $tempoEvent->range = $end - $start;

        $tempoEvent->quarterNoteDuration = $tempoEvent->bpm / 15;
        return $tempoEvent;
    }

    /**
     * Get tempo events and put is into array
     *
     * @return stdClass[]
     */
    public function getTempoEvents()
    {
        $tempoEvents = array();
        $duration = 0;
        $currentTempo = 0;
        $t = 0;
        $track = $this->tracks[0];
        $f = 1 / $this->getTimebase() / 1000000;
        $start = 0;

        foreach ($this->tracks as $trk) {
            $mc = count($trk);
            for ($i = 0; $i < $mc; $i++) {
                $msg = explode(' ', $trk[$i]);
                if (@$msg[1] == 'Tempo') {
                    $dt = (int)$msg[0] - $t;
                    $duration += $dt * $currentTempo * $f;
                    $t = (int)$msg[0];
                    $currentTempo = (int)$msg[2];

                    $end = $duration;

                    $tempoEvents[] = $this->getTempoEvent($currentTempo, $start, $end);

                    $start = $end;
                }
            }
        }
        # find last event in all tracks
        $end_time = $t;
        foreach ($this->tracks as $track) {
            $msg = explode(' ', $track[count($track) - 1]);
            $end_time = max($end_time, (int)$msg[0]);
        }
        if ($end_time > $t) {
            $dt = $end_time - $t;
            $duration += $dt * $currentTempo * $f;

            $end = $duration;
            $tempoEvents[] = $this->getTempoEvent($currentTempo, $start, $end);
        }
        return $tempoEvents;
    }

    /**
     * returns duration in seconds
     *
     * @access public
     * @return int absolute time
     */
    public function getAbsoluteTime($relativeTime)
    {
        $duration = 0;
        $currentTempo = 0;
        $t = 0;
        
        $f = 1 / $this->getTimebase() / 1000000;

        foreach ($this->tracks as $trk) {
            $mc = count($trk);
            for ($i = 0; $i < $mc; $i++) {
                $msg = explode(' ', $trk[$i]);

                $tm = (int)@$msg[0];
                if ($tm > $relativeTime) {
                    break 2;
                }

                if (@$msg[1] == 'Tempo') {
                    $dt = (int)$msg[0] - $t;
                    $duration += $dt * $currentTempo * $f;
                    $t = (int)$msg[0];
                    $currentTempo = (int)$msg[2];
                }
            }
        }

        $dt = $relativeTime - $t;
        $duration += $dt * $currentTempo * $f;
        return $duration * 1000;
    }

    /**
     *
     * @access public
     * @return int tempo
     */
    public function getTempo()
    {
        return $this->tempo;
    }
} 
