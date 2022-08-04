<?php

namespace app\Services;

use App\Exceptions\NotEnoughMoneyOnBalanceException;
use App\Interfaces\PaymentServiceInterface;
use App\Models\Account\Account;
use App\Models\Operation\OperationContainer;
use App\Models\Operation\TopUpOperation;
use App\Models\Operation\TransferOperation;
use App\Models\Operation\WithdrawOperation;

class PaymentService implements PaymentServiceInterface
{
    public function topUp(int $price, string $comment, Account $account)
    {
        try {
            $operation = new TopUpOperation($price, $comment, $account);
            OperationContainer::addOperation($operation);
            $account->addToBalance($price);
        } catch (\Exception $e) {
            echo '<br>' . $e->getMessage(); die;
        }
    }

    public function withdraw(int $price, string $comment, Account $account)
    {
        try {
            if ($price > $account->getBalance()) {
                throw new NotEnoughMoneyOnBalanceException();
            }

            $operation = new WithdrawOperation($price, $comment, $account);
            OperationContainer::addOperation($operation);
            $account->withdrawFromBalance($price);
        } catch (\Exception $e) {
            echo '<br>' . $e->getMessage(); die;
        }
    }

    public function transfer(int $price, string $comment, Account $senderAccount, Account $receiverAccount)
    {
        try {
            if ($price > $senderAccount->getBalance()) {
                throw new NotEnoughMoneyOnBalanceException();
            }

            $operation = new TransferOperation($price, $comment, $senderAccount, $receiverAccount);
            OperationContainer::addOperation($operation);
            $senderAccount->withdrawFromBalance($price);
            $receiverAccount->addToBalance($price);
        } catch (\Exception $e) {
            echo '<br>' . $e->getMessage(); die;
        }
    }
}