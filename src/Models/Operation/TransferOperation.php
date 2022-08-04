<?php

namespace App\Models\Operation;

use App\Models\Account\Account;

class TransferOperation extends Operation
{
    protected Account $senderAccount;
    protected Account $receiverAccount;

    public function __construct(int $price, string $comment, Account $senderAccount, Account $receiverAccount)
    {
        parent::__construct($price, $comment);

        $this->senderAccount = $senderAccount;
        $this->receiverAccount = $receiverAccount;
    }

    public function getSenderAccount(): Account
    {
        return $this->senderAccount;
    }

    public function getReceiverAccount(): Account
    {
        return $this->receiverAccount;
    }
}