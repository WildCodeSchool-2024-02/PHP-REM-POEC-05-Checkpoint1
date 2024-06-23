<?php

$connection = new PDO(DSN.";charset=utf8", USER, PASS);

//Afficher les bribes
$statement = $connection->query('SELECT name,payment FROM bribe ORDER BY name');
$bribes = $statement->fetchAll(PDO::FETCH_ASSOC);


$errors = [];

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $bribe = array_map('trim', $_POST);

    // Valider les données
    if (empty($bribe['name'])) {
        $errors[] = 'The name is required';
    }
    if (empty($bribe['payment'])) {
        $errors[] = 'The amount is required';
    }
    if (!empty($bribe['name']) && $bribe['payment'] < 1) {
        $errors[] = 'Please enter a valid amount';
    }

    //Ajouter les bribes
    if (empty($errors)) {
        $query = 'INSERT INTO bribe(name, payment) VALUES (:name, :payment)';
        $statement = $connection->prepare($query);
        $statement->bindValue(':name', $bribe['name'], PDO::PARAM_STR);
        $statement->bindValue(':payment', $bribe['payment'], PDO::PARAM_INT);
        $statement->execute();
        header('Location: book.php');
    }
}
