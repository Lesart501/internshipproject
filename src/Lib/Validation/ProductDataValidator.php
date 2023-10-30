<?php

namespace App\Lib\Validation;

class ProductDataValidator
{
    private const MIN_NAME = 5;
    private const MAX_NAME = 64;
    private const MAX_CODE = 10;
    private const MAX_DESCRIPTION = 300;
    private const CODE_REGEX = '/^\d{1,3}-\d+$/';
    private const PRICE_REGEX = '/^\d+\.\d{2}$/';

    private array $errors = [];

    public function validate(array $input): array
    {
        $errors = [];
        if (!$this->isDataComplete($input)) {
            $this->errors[] = 'Получены некорректные данные';
            return [
                'success' => false,
                'errors' => $this->errors,
            ];
        }
        if (!$this->isNameValid($input['name'])) {
            $this->errors[] = 'Наименование должно быть строкой не менее 5 символов и не более 64 символов';
        }
        if (!$this->isCodeValid($input['code'])) {
            $this->errors[] = 'Код товара должен быть строкой не более 10 символов, сформированной по шаблону: код поставщика-код товара (пример: 12-000134), где код поставщика не более 3 символов';
        }
        if (!$this->isDescriptionValid($input['description'])) {
            $this->errors[] = 'Описание должно быть не длиннее 300 символов';
        }
        if (!$this->isPriceValid($input['price'])) {
            $this->errors[] = 'Цена должна быть числом с двумя знаками посте запятой';
        }
        if ($this->errors != []) {
            return [
                'success' => false,
                'errors' => $this->errors,
            ];
        }
        return ['success' => true];
    }

    public function isNameValid(string $name): bool
    {
        return strlen($name) >= self::MIN_NAME || strlen($name) <= self::MAX_NAME;
    }

    public function isCodeValid(string $code): bool
    {
        if (strlen($code) > self::MAX_CODE || !preg_match(self::CODE_REGEX, $code)) {
            return false;
        }
        return true;
    }

    public function isDescriptionValid(string $description): bool
    {
        return strlen($description) <= self::MAX_DESCRIPTION;
    }

    public function isPriceValid(string $price): bool
    {
        return preg_match(self::PRICE_REGEX, $price) ? true : false;
    }
    
    public function isDataComplete(array $input): bool
    {
        return
            $input != [] &&
            isset($input['id']) && isset($input['name']) && isset($input['code']) &&
            isset($input['description']) && isset($input['price']) &&
            isset($input['amount']) && isset($input['is_available']) &&
            is_numeric($input['id']) && is_numeric($input['amount']);
    }

    public function checkPrice(string $price): array
    {
        if (!$this->isPriceValid($price)) {
            return [
                'success' => false,
                'errors' => 'Цена должна быть числом с двумя знаками посте запятой',
            ];
        }
        return ['success' => true];
    }
    
    public function checkAmount(string $amount): array
    {
        if (!is_numeric($amount)) {
            return [
                'success' => false,
                'errors' => 'Количество должно быть числом',
            ];
        }
        return ['success' => true];
    }
}