<?php

namespace App\Lib\Formatting;

class ProductDataFormatter extends Formatter
{
    /**
     * Функция преобразования данных продукта в требуемый вид
     * 
     * @param array $input
     * @return array
     */
    public function convertDataTypes(array $input): array
    {
        $newArr = [];
        $newArr['id'] = (int) $input['id'];
        $newArr['name'] = $this->formatString($input['name']);
        $newArr['code'] = $this->formatString($input['code']);
        $newArr['description'] = $this->formatString($input['description']);
        $newArr['price'] = $this->formatString($input['price']);
        $newArr['amount'] = (int) $input['amount'];
        $newArr['is_available'] = (bool) $input['is_available'];
        return $newArr;
    }
}