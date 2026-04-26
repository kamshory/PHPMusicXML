<?php

namespace Midi;

/**
 * Class MidiTrim
 *
 * Extends Midi to support trimming MIDI songs and tracks.
 *
 * @package Midi
 */
class MidiTrim extends Midi
{

	/**
	 * trims song to section from $from to $to (or to the end, if $to is omitted)
	 *
	 * @param integer $from
	 * @param integer|boolean $to
	 * @return void
	 */
	public function trimSong($from = 0, $to = false)
	{
		$tc = count($this->tracks);
		for ($i = 0; $i < $tc; $i++) {
			$this->trimTrack($i, $from, $to);
		}
	}

	/**
	 * trims track to section from $from to $to (or to the end, if $to is omitted)
	 *
	 * @param integer $tn
	 * @param integer $from
	 * @param integer|boolean $to
	 * @return void
	 */
	public function trimTrack($tn, $from = 0, $to = false)
	{
		$track = $this->tracks[$tn];
		$new = array();
		foreach ($track as $msgStr) {
			$msg = explode(' ', $msgStr);
			$t = (int)$msg[0];
			if ($t == 0) {
				$new[] = $msgStr;
			} else if ($t >= $from && ($t <= $to || $to === false)) {
				$msg[0] = $t - $from;
				$new[] = join(' ', $msg);
			}
		}
		if ($to) {
			$new[] = ($to - $from) . ' Meta TrkEnd'; // bug-fix!
		}
		$this->tracks[$tn] = $new;
	}

	/**
	 * Convert timestamp to seconds
	 *
	 * @param integer $ts
	 * @return float|integer
	 */
	public function timestamp2seconds($ts)
	{
		return $ts * $this->getTempo() / $this->getTimebase() / 1000000;
	}

	/**
	 * Convert seconds to timestamp
	 *
	 * @param float|integer $sec
	 * @return integer
	 */
	public function seconds2timestamp($sec)
	{
		return (int)($sec * 1000000 * $this->getTimebase() / $this->getTempo());
	}
}
