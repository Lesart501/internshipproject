<?php

namespace App\Models;

class Product
{
    protected int $id;
    protected string $name;
    protected string $code;
    protected string $description;
    protected string $price;
    protected int $amount;
    protected bool $isAvailable;

    public function __construct(
        int $id,
        string $name,
        string $code,
        string $description,
        string $price,
        int $amount,
        bool $is_available
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->code = $code;
        $this->description = $description;
        $this->price = $price;
        $this->amount = $amount;
        $this->isAvailable = $is_available;
    }

    public static function createFromArray(array $input): self
    {
        return new Product(
            $input['id'], $input['name'], $input['code'], $input['description'],
            $input['price'], $input['amount'], $input['is_available']
        );
    }

    // Ниже идут геттеры и сеттеры
    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCode(): string
    {
        return $this->code;
    }
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPrice(): string
    {
        return $this->price;
    }
    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function isAvailable(): bool
    {
        return $this->isAvailable;
    }
    public function setAvailable(bool $isAvailable): void
    {
        $this->isAvailable = $isAvailable;
    }
}