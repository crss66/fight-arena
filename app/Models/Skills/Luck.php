<?php

namespace app\Models\Skills;

class Luck extends DeffensiveSkill {

      /**
     * luck is evading incoming damage
     * @return int
     */
    public function applySkill($value) {
        return 0;
    }
}