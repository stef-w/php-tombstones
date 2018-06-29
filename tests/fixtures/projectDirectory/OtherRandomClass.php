<?php
/**
 * Created by PhpStorm.
 * User: stef
 * Date: 29/06/2018
 * Time: 09:30
 */

class OtherRandomClass
{
    private $graveyard;


    /**
     * A docblock for some extra lines for testing
     *
     * @param \StefW\Tombstones\Graveyard $graveyard
     */
    public function __construct(\StefW\Tombstones\Graveyard $graveyard)
    {
        $this->graveyard = $graveyard;
    }

    /**
     *
     */
    public function thisIsAnAliveMethod()
    {
        $this->graveyard->tombstone(__FILE__, __LINE__);
    }

    /**
     *
     */
    public function thisIsADeadMethod()
    {
        $this->graveyard->tombstone(__FILE__, __LINE__);
    }
}