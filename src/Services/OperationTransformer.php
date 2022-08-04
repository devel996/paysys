<?php

namespace app\Services;

use App\Exceptions\WrongOperationException;
use App\Models\Operation\Operation;
use App\Models\Operation\TopUpOperation;
use App\Models\Operation\TransferOperation;
use App\Models\Operation\WithdrawOperation;

class OperationTransformer
{
    private Operation $operation;

    public function __construct(Operation $operation)
    {
        $this->operation = $operation;
    }

    public function getData(): array
    {
        if ($this->operation instanceof TopUpOperation) {
            return $this->getTopUpData();
        } elseif ($this->operation instanceof  WithdrawOperation) {
            return $this->getWithdrawData();
        } elseif ($this->operation instanceof TransferOperation) {
            return $this->getTransferData();
        }

        throw new WrongOperationException();
    }

    private function getCommonData(): array
    {
        return [
            'id' => $this->operation->getId(),
            'price' => $this->operation->getPrice(),
            'comment' => $this->operation->getComment(),
            'dateTime' => $this->operation->getDateTime()
        ];
    }

    private function getTopUpData(): array
    {
        return array_merge($this->getCommonData(), [
           'type' => 'TOPUP',
           'accountId' => $this->operation->getAccount()->getId(),
           'accountBalanceBeforeTransaction' => $this->operation->getAccount()->getBalance(),
           'accountBalanceAfterTransaction' => $this->operation->getAccount()->getBalance() + $this->operation->getPrice(),
        ]);
    }

    private function getWithdrawData(): array
    {
        return array_merge($this->getCommonData(), [
            'type' => 'WITHDRAW',
            'accountId' => $this->operation->getAccount()->getId(),
            'accountBalanceBeforeTransaction' => $this->operation->getAccount()->getBalance(),
            'accountBalanceAfterTransaction' => $this->operation->getAccount()->getBalance() - $this->operation->getPrice(),
        ]);
    }

    private function getTransferData(): array
    {
        return array_merge($this->getCommonData(), [
            'type' => 'TRANSFER',
            'senderAccountId' => $this->operation->getSenderAccount()->getId(),
            'senderAccountBalanceBeforeTransaction' => $this->operation->getSenderAccount()->getBalance(),
            'senderAccountBalanceAfterTransaction' => $this->operation->getSenderAccount()->getBalance() - $this->operation->getPrice(),
            'receiverAccountId' => $this->operation->getReceiverAccount()->getId(),
            'receiverAccountBalanceBeforeTransaction' => $this->operation->getReceiverAccount()->getBalance(),
            'receiverAccountBalanceAfterTransaction' => $this->operation->getReceiverAccount()->getBalance() + $this->operation->getPrice(),
        ]);
    }
}