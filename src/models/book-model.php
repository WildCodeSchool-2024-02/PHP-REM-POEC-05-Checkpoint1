<?php

function createConnection(): PDO
{
    return new PDO("mysql:host=" . SERVER . ";dbname=" . DATABASE . ";charset=utf8", USER, PASSWORD);
}

function getAllBrides(): array|false
{
    $connection = createConnection();

    return $connection->query('SELECT name, payment FROM bride ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);
}

function saveBride(array $bride): void
{
    $connection = createConnection();

    $query = 'INSERT INTO bride(name, payment) VALUES (:name, :payment)';
    $statement = $connection->prepare($query);
    $statement->bindValue(':name', $bride['name']);
    $statement->bindValue(':payment', $bride['payment']);
    $statement->execute();
}
