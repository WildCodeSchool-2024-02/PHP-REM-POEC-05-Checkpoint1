<?php

require __DIR__ . '/../models/payment-model.php';

function showPayment(): void
{
    $payments = getAllPayments();
    // var_dump($payments);
    require __DIR__ . '/../views/payment-view.php';
}