<?php

namespace App\Core;

use App\Lib\Exceptions\CustomException;

use DateTime;
use DateTimeZone;

class Logger
{
    protected const EXCEPTIONS_DIR = LOGS_DIR . 'exceptions/';
    protected const EXCEPTIONS_FILE_NAME = 'caughtExceptions.log';

    public function logException(CustomException $exception): void
    {
        $date = new DateTime('now', new DateTimeZone('Europe/Moscow'));
        if (!file_exists(self::EXCEPTIONS_DIR . self::EXCEPTIONS_FILE_NAME)) {
            mkdir(self::EXCEPTIONS_DIR);
        }
        $record = $date->format('Y-m-d H:i:s') . ': ' . $exception->getCode() . '. ' . $exception->getMessage();
        file_put_contents(self::EXCEPTIONS_DIR . self::EXCEPTIONS_FILE_NAME, $record . PHP_EOL , FILE_APPEND);
    }
}