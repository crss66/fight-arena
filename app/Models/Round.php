<?php

namespace app\Models;


class Round {
    // track stats and events of a round
    public $round_data = [];
 
    
    /**
     * get rounds of the battle
     * set round data
     * @return array $data
     */
    public function setData($data) {
        $this->round_data = $data;
    }

    /**
     * return atacker and defender data for this round
     * @return array
     */
    public function getData() {
        return $this->round_data;
    }
}