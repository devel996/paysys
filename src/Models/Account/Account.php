<?php

namespace App\Models\Account;

class Account
{
    private const PREFIX = 'Account';

    private string $id;
    private int $balance;

    public function __construct(int $balance)
    {
        $this->balance = $balance;
        $this->id = uniqid(self::PREFIX);

        AccountContainer::addAccount($this);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getBalance(): int
    {
        return $this->balance;
    }

    public function setBalance(int $balance): void
    {
        $this->balance = $balance;
    }

    public function addToBalance(int $price): void
    {
        $this->balance += $price;
    }

    public function withdrawFromBalance(int $price): void
    {
        $this->balance -= $price;
    }
}