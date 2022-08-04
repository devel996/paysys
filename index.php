<?php

require_once "vendor/autoload.php";

$paymentController = new \App\Controllers\PaymentController();

$paymentController->run();