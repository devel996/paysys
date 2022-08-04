<?php

namespace App\Exceptions;

class NotEnoughMoneyOnBalanceException extends \Exception
{
    protected $message = 'Account has not enough money on balance';
}