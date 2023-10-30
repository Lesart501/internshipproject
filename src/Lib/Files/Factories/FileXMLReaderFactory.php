<?php

namespace App\Lib\Files\Factories;

use App\Lib\Files\Interfaces\FileReaderFactoryInterface;
use App\Lib\Files\FileXMLReader;

class FileXMLReaderFactory implements FileReaderFactoryInterface
{
    public function make(string $filename)
    {
        return new FileXMLReader($filename);
    }
}