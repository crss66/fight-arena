<?php

namespace app\Models\Skills;

class RapidStrike extends OffensiveSkill {

    /**
     * rapid strike is doubling damage
     * @return int
     */
    public function applySkill($value) {
        return $value*2;
    }
}