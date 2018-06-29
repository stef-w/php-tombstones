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

    /**
     * @var string
     */
    private $directory;

    /**
     * Graveyard constructor.
     *
     * @param                  $directory
     * @param StorageInterface $storage
     */
    public function __construct($directory, StorageInterface $storage)
    {
        $this->storage   = $storage;
        $this->directory = $directory;
    }

    /**
     * Place a Tombstone
     *
     * @param        $file
     * @param        $line
     */
    public function tombstone($file, $line)
    {
        $this->storage->openTombstone(new Tombstone($file, $line));
    }

    /**
     * @return Tombstone[]
     */
    public function getAllTombstones()
    {
        return $this->getTombstonesFromDirectory($this->directory);
    }

    private function getTombstonesFromDirectory($directory)
    {
        $tombstones = [];
        $items      = glob($directory . '/*');

        foreach ($items as $item) {

            if (is_dir($item)) {
                $children   = $this->getTombstonesFromDirectory($item);
                $tombstones = array_merge($tombstones, $children);
                continue;
            }

            $ext = strtolower(end(explode('.', $item)));
            if ($ext !== 'php') {
                continue;
            }

            foreach (file($item) as $lineNumber => $line) {
                $line = str_replace(' ', '', $line);
                if (strpos($line, '->tombstone(__FILE__,__LINE__') !== false) {
                    $tombstones[] = new Tombstone($item, $lineNumber + 1);
                }
            }
        }

        return $tombstones;
    }

    /**
     * @return Tombstone[]
     */
    public function getClosedTombstones()
    {
        $closed = [];
        $open   = $this->storage->getOpenedTombstones();
        foreach ($this->getAllTombstones() as $tombstone) {
            if (!in_array($tombstone, $open)) {
                $closed[] = $tombstone;
            }
        }

        return $closed;
    }

    /**
     * @return Tombstone[]
     */
    public function getOpenedTombstones()
    {
        $data =  $this->storage->getOpenedTombstones();
        return array_values($data);
    }
}