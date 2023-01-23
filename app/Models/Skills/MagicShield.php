<?php

namespace app\Models\Skills;

use app\Models\BaseStat;

class MagicShield extends DeffensiveSkill {

      /**
     * magic shield is dividing incoming damage with 2
     * @return int
     */
    public function applySkill($value) {
        return $value/2;
    }
}