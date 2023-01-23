<?php

namespace app\Models;

class Battle {
    public $winner = null;
    public $rounds = [];

    /**
     * get the winner of the battle
     * @return Hero
     */
    public function getWinner() {
        return $this->winner;
    }

    /**
     * set the winner of the battle
     * @param Hero $winner
     */
    public function setWinner(Hero $winner) {
        $this->winner = $winner;
    }

    /**
     * keep track of rounds in battle
     * @param Round $round
     */
    public function pushRound(Round $round) {
        $this->rounds[] = $round;
    }

    /**
     * get rounds of the battle
     * @return Round[]
     */
    public function getRounds() {
        return $this->rounds;
    }

    
}