<?php


function createConnection(): PDO
{
    return new PDO("mysql:host=" . SERVER . ";dbname=" . DATABASE . ";charset=utf8", USER, PASSWORD);
}

function getAllBook(): array|false
{
    $connection = createConnection();

    $statement = $connection->query('SELECT id, name , payment FROM bribe');
    $books = $statement->fetchAll(PDO::FETCH_ASSOC);

    $statement = $connection->query('SELECT SUM(payment) AS total_payment FROM bribe');
    $totalPayment = $statement->fetch(PDO::FETCH_ASSOC)['total_payment'];



    return [
        'books' => $books,
        'total_payment' => $totalPayment
    ];
}

function savebook(array $book): void
{
    $connection = createConnection();

    $query = 'INSERT INTO bribe(name, payment) VALUES (:name, :payment)';
    $statement = $connection->prepare($query);
    $statement->bindValue(':name', $book['name'], PDO::PARAM_STR);
    $statement->bindValue(':payment', $book['payment'], PDO::PARAM_STR);
    $statement->execute();
}