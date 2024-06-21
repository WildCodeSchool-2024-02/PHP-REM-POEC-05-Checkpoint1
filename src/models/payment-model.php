<?php

function createConnection(): PDO
{
    return new PDO("mysql:host=" . SERVER . ";dbname=" . DATABASE . ";charset=utf8", USER, PASSWORD);
}

function getAllPayments(): array|false
{
    $connection = createConnection();

    $statement = $connection->query('SELECT name, payment FROM bribe ORDER BY name');
    $payments = $statement->fetchAll(PDO::FETCH_ASSOC);

    // var_dump($payments);
    return $payments;
}