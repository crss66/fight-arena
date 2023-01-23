<?php

namespace app\Controllers;

use app\Models\Battle;
use app\Models\Hero;
use app\Models\Round;
use app\Models\Skills\Luck;
use app\Models\Skills\MagicShield;
use app\Models\Skills\RapidStrike;
use app\Models\Stat;
use Exception;

class BattleController {

    public $battle;
    private $player_1;
    private $player_2;
    private $rounds = 20;

    
    function __construct()
    {
        $this->initHeroes();
    }


    private function initHeroes() {
        //assignation of players
            //higher speed
            //if same speed -> highest luck
            $orderus_stats = [
                'health'        => new Stat('Health', rand(70, 100), 'number'),
                'strength'      => new Stat('Strength', rand(70, 80), 'number'),
                'defence'       => new Stat('Defence', rand(45, 55), 'number'),
                'speed'         => new Stat('Speed', rand(40, 50), 'number'),
            
                'luck'          => new Luck('Luck', rand(10, 30), 'percent'),
                'rapid_strike'  => new RapidStrike('Rapid Strike', 10, 'percent'),
                'magic_shield'  => new MagicShield('Magic shield', 20, 'percent'),
            ];
            
            $wildBeast_stats = [
                'health'    => new Stat('Health', rand(60, 90), 'number'),
                'strength'  => new Stat('Strength', rand(60, 90), 'number'),
                'defence'   => new Stat('Defence', rand(40, 60), 'number'),
                'speed'     => new Stat('Speed', rand(40, 60), 'number'),
            
                'luck'      => new Luck('Luck', rand(25, 40), 'percent'),
            ];
            $hero_1 =  new Hero('Orderus', $orderus_stats);
            $hero_2 =  new Hero('Wild Beast', $wildBeast_stats);

        if($hero_1->getStatValue('speed') > $hero_2->getStatValue('speed')) {
            $this->player_1 = $hero_1;
            $this->player_2 = $hero_2;
            
        } else if($hero_1->getStatValue('speed') < $hero_2->getStatValue('speed')) {
            $this->player_1 = $hero_2;
            $this->player_2 = $hero_1;
        } else {
            //maybe they'll have equal luck so player 1 will attack first
            if($hero_1->getStatValue('luck') >= $hero_2->getStatValue('luck')) {
                $this->player_1 = $hero_1;
                $this->player_2 = $hero_2;
            } else {
                $this->player_1 = $hero_2;
                $this->player_2 = $hero_1;
            }
        }
    }


    public function doBattle() {

        $this->battle = new Battle();
        $i = 1;
        $initial_player_1_health = $this->player_1->getCurrentHealth();
        $initial_player_2_health = $this->player_2->getCurrentHealth();

        while($i <= $this->rounds) {
            $atacker = null;
            $defender = null;
            $round = new Round();
            if($i % 2 == 0) {
               $atacker = $this->player_1;
               $defender = $this->player_2;
            } else {
                $atacker = $this->player_2;
                $defender = $this->player_1;
            }

            $damage_value = $atacker->getStatValue('strength') - $defender->getStatValue('defence');

            $atacker_data = $atacker->applyAtackSkills($damage_value);
            $defender_data = $defender->applyDefenceSkills($atacker_data['value']);
            $damage_value = $defender_data['value'] > 0 ? $defender_data['value'] : 0;

            $defender->removeHealth( $damage_value );
            

            $round->setData([
                'atacker' => [
                    'name' => $atacker->getName(),
                    'current_health' => $atacker->getCurrentHealth(),
                    'data' => $atacker_data,
                    'damage' => $damage_value
                ], 
                'defender' => [
                    'name' => $defender->getName(),
                    'current_health' => $defender->getCurrentHealth(),
                    'data' => $defender_data,
                ]
            ]);

            $this->battle->pushRound($round);
            $i++;

            if($this->player_1->getCurrentHealth() == 0) {
                $this->battle->setWinner($this->player_2);
                break;
            }

            if($this->player_2->getCurrentHealth() == 0) {
                $this->battle->setWinner($this->player_2);
                break;
            } 
        }

        include __DIR__ . './../Views/index.view.php';
    }

}