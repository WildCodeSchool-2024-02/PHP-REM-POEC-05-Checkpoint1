<?php

function createConnection(): PDO
{
    return new PDO("mysql:host=localhost ;dbname= checkpoint1 ;charset=utf8, USER=Ido, PASSWORD =Eden2017+");
}

// Afficher les noms par ordre alphabétique et payements
function getBribe(): array|false
{
    $connection = createConnection();
    $statement = $connection->query('SELECT nom, payement FROM bribe ORDER BY nom ASC');
    $bribes = $statement->fetch(PDO::FETCH_ASSOC);
    return $bribes;
}
// Faire la somme des payements
function getSumBribe(): array|false
{
    $connection = createConnection();

    $statement = $connection->query('SELECT SUM(payement) AS total_payement FROM bribe');
    $total_payement = $statement->fetch(PDO::FETCH_ASSOC);
    return $total_payement;
}