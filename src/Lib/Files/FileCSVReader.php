<?php

namespace App\Lib\Files;

use App\Lib\Files\Interfaces\DataFileReaderInterface;
use Generator;

class FileCSVReader extends FileReader implements DataFileReaderInterface
{
    public function takeHeaders(): array
    {
        $headers = fgetcsv($this->file, 1024);
        return $headers;
    }

    public function takeValues(): Generator
    {
        while(!feof($this->file)) {
            $row = fgetcsv($this->file, 1024);
            yield $row;
        }
    }

    public function convertToArray(): array
    {
        $result = [];
        $headers = $this->takeHeaders();
        $arrays = $this->takeValues();
        foreach ($arrays as $row) {
            $result[] = array_combine($headers, $row);
        }
        return $result;
    }
}