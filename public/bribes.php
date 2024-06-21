<?php
require_once __DIR__.'/../connec.php';

$connection = new PDO(DSN, PASS, USER);


$query = "SELECT name, payment FROM bribe ";
    $statement = $connection->query($query);
    $bribes= $statement->fetchAll(PDO::FETCH_ASSOC);


$totalPayment = array_sum(array_column($bribes, 'payment'));

require __DIR__.'/../public/book.php';



