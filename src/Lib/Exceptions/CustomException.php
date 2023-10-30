<?php

namespace App\Lib\Exceptions;

use Exception;

class CustomException extends Exception
{
    public function __construct(int $code)
    {
        parent::__construct();
        $this->code = $code;
    }

    public function defineException(): void
    {
        switch ($this->code) {
            case 400:
                $this->message = BAD_REQUEST;
                break;
            case 404:
                $this->message = PAGE_NOT_FOUND;
                break;
        }
    }
}