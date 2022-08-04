<?php

namespace App\Controllers;

use App\Models\Account\Account;
use App\Models\Account\AccountContainer;
use App\Models\Operation\OperationContainer;
use App\Services\PaymentService;
use App\Services\View;

class PaymentController
{
    public function run()
    {
        $paymentService = new PaymentService();

        $acc1 = new Account(300);
        $acc2 = new Account(1000);
        $acc3 = new Account(88888);

        View::start();

        View::show(AccountContainer::getAccountsList()); // get all accounts array

        View::show(AccountContainer::getAccountById($acc2->getId())); // get one account by id

        $paymentService->transfer(35, "Send to Acc2", $acc1, $acc2); // transfer from 1st account to second
        $paymentService->withdraw(1000, "withdraw money", $acc2); // withdraw from account's balance
        $paymentService->topUp(25, "Adding money", $acc1); // top up account's balance
        $paymentService->topUp(123, "Adding money", $acc3); // top up account's balance
        $paymentService->topUp(987, "Adding money", $acc3); // top up account's balance

//        View::show(OperationContainer::getOperationsList()); // get all operations list

        echo "<br>[Sorted By Comments | ASC]<br>";
        View::show(OperationContainer::getCommentSortedOperationsList()); // get all operations list sorted by comment


        echo "<br>[Sorted By DateTime | DESC]<br>";
        View::show(OperationContainer::getDateTimeSortedOperationsList()); // get all operations list sorted by datetime

        View::finish();
    }
}