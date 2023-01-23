<?php

namespace app\Models;

abstract class BaseStat {
    private $stat_name = '';
    private $stat_value = 0;
    private $value_type = '';
    private $stat_type = 'static';

    /**
     * @param string $stat_name
     * @param int $stat_value
     * @param string $value_type
     */
    function __construct($stat_name, $stat_value, $value_type)
    {
        //initialization of stat

        $this->stat_name    = $stat_name;
        $this->stat_value   = $stat_value;
        $this->value_type   = $value_type;
        
    }

    /**
     * get the stat value
     * @return int|string $stat_value
     */
    public function getValue() {
        return $this->stat_value;
    }


    
    /**
     * set value of the stat
     * @param int|string $stat_value
     */
    public function setValue($stat_value) {
        $this->stat_value = $stat_value;
    }

    /**
     * return stat name
     * @return string $stat_name
     */
    public function getName() {
        return $this->stat_name;
    }
}