<?php

namespace App\Traits;

use App\Models\Account\Account;

trait InternalOperationTrait
{
    protected Account $account;

    public function __construct(int $price, string $comment, Account $account)
    {
        parent::__construct($price, $comment);

        $this->account = $account;
    }

    public function getAccount(): Account
    {
        return $this->account;
    }
}