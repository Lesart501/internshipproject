<?php

namespace App\Lib\Files;

use App\Lib\Files\Interfaces\FileReaderInterface;

class FileReader implements FileReaderInterface
{
    protected string $fileName;
    protected $file;
    protected string $pathToFile;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
        $this->pathToFile = STORAGE_DIR . $fileName;
    }

    public function open(): void
    {
        $this->file = fopen($this->pathToFile, 'r');
    }

    public function read(): string
    {
        $content = fread($this->file, filesize($this->pathToFile));
        return $content;
    }

    public function close(): void
    {
        fclose($this->file);
    }
}