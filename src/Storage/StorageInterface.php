<?php
/**
 * Created by PhpStorm.
 * User: stef
 * Date: 08/02/2018
 * Time: 15:18
 */

namespace StefW\Tombstones\Storage;

use StefW\Tombstones\Tombstone;

interface StorageInterface
{
    /**
     * @param Tombstone $tombstone
     * @return void
     */
    public function openTombstone(Tombstone $tombstone);

    /**
     * @return Tombstone[]
     */
    public function getOpenedTombstones();
}