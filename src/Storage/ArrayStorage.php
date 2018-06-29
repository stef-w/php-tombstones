<?php
/**
 * Created by PhpStorm.
 * User: stef
 * Date: 08/02/2018
 * Time: 15:34
 */

namespace StefW\Tombstones\Storage;


use StefW\Tombstones\Tombstone;

class ArrayStorage implements StorageInterface
{

    private $data;

    /**
     * @param Tombstone $tombstone
     * @return void
     */
    public function openTombstone(Tombstone $tombstone)
    {
        $this->data[$tombstone->getId()] = $tombstone->toArray();
    }

    /**
     * @return Tombstone[]
     */
    public function getOpenedTombstones()
    {
        return array_map(function($row){
            return Tombstone::fromArray($row);
        },$this->data);
    }
}