<?php

namespace App\Lib\Files\Interfaces;

interface FileReaderInterface
{
    public function __construct(string $fileName);

    public function open();

    public function read();

    public function close();
}