<?php

namespace App\Models\Account;

class AccountContainer
{
    private static array $accounts = [];

    public static function addAccount(Account $account)
    {
        self::$accounts[$account->getId()] = $account;
    }

    public static function getAccountsList(): array
    {
        return self::$accounts;
    }

    public static function getAccountById(string $id): Account
    {
        return self::$accounts[$id];
    }
}