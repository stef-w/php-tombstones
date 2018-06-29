<?php
/**
 * Created by PhpStorm.
 * User: stef
 * Date: 29/06/2018
 * Time: 09:30
 */

class RandomClass
{
    public $graveyard;
    public function __construct(\StefW\Tombstones\Graveyard $graveyard)
    {
        $this->graveyard = $graveyard;
    }

    public function thisIsADeadMethod()
    {
        $this->graveyard->tombstone(__FILE__, __LINE__);
    }

    public function thisIsAnAliveMethod()
    {
        $this->graveyard->tombstone(__FILE__, __LINE__);
    }

}