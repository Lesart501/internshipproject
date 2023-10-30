<?php

namespace App\Lib\Files\Interfaces;

interface FileReaderFactoryInterface
{
    public function make(string $fileName);
}