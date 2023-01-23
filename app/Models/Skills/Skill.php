<?php

namespace app\Models\Skills;

use app\Models\BaseStat;

class Skill extends BaseStat {

    /**
     * check the chance of skill triggering
     * @return boolean
     */
    public function checkIfSkillIsTriggering()
    {
        if(rand(0, 99) < $this->getValue()){
            return true;
        }
        return false;
    }
}