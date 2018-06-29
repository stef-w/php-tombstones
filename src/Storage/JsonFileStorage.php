<?php
/**
 * Created by PhpStorm.
 * User: stef
 * Date: 08/02/2018
 * Time: 15:34
 */

namespace StefW\Tombstones\Storage;


use StefW\Tombstones\Tombstone;

class JsonFileStorage implements StorageInterface
{

    private $file;

    public function __construct($filename)
    {
        $this->file = $filename;
    }

    /**
     * @param Tombstone $tombstone
     * @return void
     */
    public function openTombstone(Tombstone $tombstone)
    {
        $json = file_get_contents($this->file);
        $data = json_decode($json,true);
        $data[$tombstone->getId()] = $tombstone->toArray();

        $json = json_encode($data);
        file_put_contents($this->file, $json);
    }

    /**
     * @return Tombstone[]
     */
    public function getOpenedTombstones()
    {
        $json = file_get_contents($this->file);
        $data = json_decode($json,true);

        return array_map(function($row){
            return Tombstone::fromArray($row);
        },$data);
    }
}