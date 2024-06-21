<?php
require __DIR__ . '../../../../connec.php';


function createConnection(): PDO
{
    return new PDO(DSN . ";charset=utf8", USER, PASS);
}

function getAllBribes(): array|false
{
    $connection = createConnection();

    $statement = $connection->query('SELECT name, payment  FROM bribe order by name  ');
    $bribes = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $bribes;
}
