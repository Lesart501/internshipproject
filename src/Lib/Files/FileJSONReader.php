<?php

namespace App\Lib\Files;

use App\Lib\Files\Interfaces\DataFileReaderInterface;

class FileJSONReader extends FileReader implements DataFileReaderInterface
{
    public function convertToArray(): array
    {
        $stringData = file_get_contents($this->pathToFile);
        $jsonData = json_decode($stringData, true);
        return $jsonData;
    }
    
    public function convertToArrayOfObjects(): array
    {
        $stringData = file_get_contents($this->pathToFile);
        $jsonData = json_decode($stringData, true);
        return $jsonData;
    }
    
    public function addElement(array $element): void
    {
        $stringData = file_get_contents($this->pathToFile);
        $array = json_decode($stringData, true);
        $array[] = $element;
        file_put_contents($this->pathToFile, json_encode($array, JSON_UNESCAPED_UNICODE));
    }
    
    public function editElement(int $index, array $element): void
    {
        $stringData = file_get_contents($this->pathToFile);
        $array = json_decode($stringData, true);
        $array[$index] = $element;
        file_put_contents($this->pathToFile, json_encode($array, JSON_UNESCAPED_UNICODE));
    }
    
    public function deleteElement(int $index): void
    {
        $stringData = file_get_contents($this->pathToFile);
        $array = json_decode($stringData, true);
        unset($array[$index]);
        file_put_contents($this->pathToFile, json_encode($array, JSON_UNESCAPED_UNICODE));
    }
    
    public function updateFile(array $data): void
    {
        file_put_contents($this->pathToFile, json_encode($data, JSON_UNESCAPED_UNICODE));
    }
}