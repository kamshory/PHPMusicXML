<?php
use Midi\MidiInstrument;
require_once "inc.lib/autoload.php";

$midi = new MidiInstrument();

$midi->importMid("lagu.mid");

$list = $midi->getInstrument();

print_r($list);