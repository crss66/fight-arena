<?php

use app\Controllers\BattleController;
use app\Models\Hero;
use app\Models\Stat;
use app\Models\Skills\Luck;
use app\Models\Skills\MagicShield;
use app\Models\Skills\RapidStrike;

require 'vendor/autoload.php';

$battle = new BattleController();

//do battle and output it
$battle->doBattle();
