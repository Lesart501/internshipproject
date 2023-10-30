<?php

namespace App\Lib\Files\Interfaces;

interface DataFileReaderInterface extends FileReaderInterface
{
    public function convertToArray();
}