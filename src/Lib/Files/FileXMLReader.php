<?php

namespace App\Lib\Files;

use App\Lib\Files\Interfaces\DataFileReaderInterface;

class FileXMLReader extends FileReader implements DataFileReaderInterface
{    
    public function convertToArray(): array
    {
        $obj = simplexml_load_file($this->pathToFile);
        $json = json_encode($obj);
        $array = json_decode($json, true);
        foreach ($array as $arr) {
            $result = $arr;
        }
        return $result;
    }
}