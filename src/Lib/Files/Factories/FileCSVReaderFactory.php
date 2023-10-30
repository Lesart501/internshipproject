<?php

namespace App\Lib\Files\Factories;

use App\Lib\Files\Interfaces\FileReaderFactoryInterface;
use App\Lib\Files\FileCSVReader;

class FileCSVReaderFactory implements FileReaderFactoryInterface
{
    public function make(string $filename)
    {
        return new FileCSVReader($filename);
    }
}