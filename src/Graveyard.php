<?php
/**
 * Created by PhpStorm.
 * User: stef
 * Date: 08/02/2018
 * Time: 15:18
 */

namespace StefW\Tombstones;

use StefW\Tombstones\Storage\StorageInterface;

class Graveyard
{
    /**
     * @var StorageInterface
     */
    private $storage;

    private $directory;

    /**
     * Graveyard constructor.
     * @param $directory
     * @param StorageInterface $storage
     */
    public function __construct($directory, StorageInterface $storage)
    {
        $this->storage = $storage;
        $this->directory = $directory;
    }

    /**
     * Place a Tombstone
     * @param $file
     * @param $line
     * @param string $comment
     */
    public function tombstone($file, $line, $comment = '')
    {
        $this->storage->openTombstone(new Tombstone($file, $line, $comment));
    }

    /**
     * @return Tombstone[]
     */
    public function getAllTombstones()
    {
        return [new Tombstone(1, 2)];
    }

    /**
     * @return Tombstone[]
     */
    public function getClosedTombstones()
    {
        $closed = [];
        $open = $this->storage->getOpenedTombstones();
        foreach ($this->getAllTombstones() as $tombstone) {
            if (!in_array($tombstone, $open)) {
                $closed[] = $tombstone;
            }
        }

        return $closed;
    }
}