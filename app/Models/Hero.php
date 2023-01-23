<?php

namespace app\Models;

use app\Models\Skills\DeffensiveSkill;
use app\Models\Skills\OffensiveSkill;

class Hero {
    public $name = '';
    public $stats = [];

    /**
     * @param string $name
     * @param Stats[] $stats
     */
    function __construct($name, $stats)
    {
        //initialization of hero
        $this->name = $name;

         /**
         * @param Stat $value
         */
        $this->stats = array_filter($stats, function($value) {
            return $value instanceof BaseStat;
        });
    }

     /**
     * @param string $stat_slug
     * @return int $stat_value
     */
    public function getStatValue($stat_slug) {
        if(isset($this->stats[$stat_slug])) {
            return $this->stats[$stat_slug]->getValue();
        }
        return 0;
    }

    /**
     * return hero name
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * return all stats of this hero
     * @return Stat[]
     */
    public function getStats() {
        return $this->stats;
    }

    /**
     * take incoming damage and apply defence skills to it
     * @param int $damage
     * @return array
     */
    public function applyDefenceSkills($damage) {
        $total_damage_received = $damage;
        $skills_applied = [];
        foreach($this->getStats() as $slug => $stat) {
            if($stat instanceof DeffensiveSkill && $stat->checkIfSkillIsTriggering() && method_exists($stat, 'applySkill')) {
                $total_damage_received = $stat->applySkill($total_damage_received);
                $skills_applied[] = $stat;
            }
        }

        return [
            'value' => $total_damage_received,
            'skills_applied' => $skills_applied
        ];
    }

    /**
     * take current damage and apply offensive skills to it
     * @param int $damage
     * @return array
     */
    public function applyAtackSkills($damage) {
        $total_damage = $damage;
        $skills_applied = [];
        foreach($this->getStats() as $slug => $stat) {
            if($stat instanceof OffensiveSkill && $stat->checkIfSkillIsTriggering() && method_exists($stat, 'applySkill')) {
                $total_damage = $stat->applySkill($total_damage);
                $skills_applied[] = $stat;
            }
        }

        return [
            'value' => $total_damage,
            'skills_applied' => $skills_applied
        ];
    }

    /**
     * remove from current health the final damage value
     * @param int $value
     * @return int
     */
    public function removeHealth($value) {
        $current_health = $this->stats['health']->getValue();
        $difference = $current_health - $value;
        if( $difference > 0 ) {
            $this->stats['health']->setValue($difference);
            return $difference;
        } else {
            $this->stats['health']->setValue(0);
            return 0;
        }
    }

    /**
     * get current health of this hero
     * @return int
     */
    public function getCurrentHealth() {
        return $this->stats['health']->getValue();
    }
}