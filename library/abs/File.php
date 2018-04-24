<?php

namespace library\abs;

abstract class File
{
    public $file = null;
    public $table_start = '<table>';
    public $table_end = '</table>';
    public $_view = null;
    public $fileInArray = null;

    public function __construct($file)
    {
        if ( file_exists($file) ) {
            $this->file = $file;
        }
        else {
            new \Exception("Файл " . $file . " не найден");
        }
    }

    abstract function readFile(): array;

    abstract function view(): string;
}