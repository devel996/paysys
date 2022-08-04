<?php

namespace App\Interfaces;

use App\Models\Account\Account;

interface PaymentServiceInterface
{
    public function topUp(int $price, string $comment, Account $account);
    public function withdraw(int $price, string $comment, Account $account);
    public function transfer(int $price, string $comment, Account $senderAccount, Account $receiverAccount);
}