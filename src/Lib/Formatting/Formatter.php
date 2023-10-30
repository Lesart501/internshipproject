<?php

namespace App\Lib\Formatting;

/**
 * Класс для общих методов форматирования и валидации
 */
abstract class Formatter
{    
    /**
     * Функция преобразует переданный параметр в строку требуемого вида:
     * удаляет пробелы в начале и в конце,
     * убирает теги HTML,
     * экранирует символы
     * и приводит строки в кодировку utf-8
     * 
     * @param mixed $val
     * @return string
     */
    public function formatString($val): string
    {
        $parsed = trim((string) $val);
        $parsed = strip_tags($parsed);
        $parsed = addslashes($parsed);
        $parsed = mb_convert_encoding($parsed, 'UTF-8');
        return $parsed;
    }
}