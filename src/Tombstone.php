<?php
/**
 * Created by PhpStorm.
 * User: stef
 * Date: 08/02/2018
 * Time: 15:18
 */

namespace StefW\Tombstones;

class Tombstone
{
    private $line;
    private $file;
    private $comment;

    public function __construct($file, $line, $comment = '')
    {
        $this->file = $file;
        $this->line = $line;
        $this->comment = $comment;
    }

    public function getId()
    {
        return md5($this->file . $this->line);
    }

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'line' => $this->line,
            'file' => $this->file,
            'comment' => $this->comment
        ];
    }

    public static function fromArray($array)
    {
        return new self($array['file'], $array['line'], $array['comment']);
    }
}