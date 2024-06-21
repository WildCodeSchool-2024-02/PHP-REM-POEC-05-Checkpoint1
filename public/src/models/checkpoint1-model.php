<?php

function createConnection(): PDO
{
    return new PDO("mysql:host=" . SERVER . ";dbname=" . DATABASE . ";charset=utf8", USER, PASS);
}

function getAllcheckpoint1(): array|false
{
    $connection = createConnection();

    $statement = $connection->query('SELECT id, title FROM checkpoint1');
    $checkpoint1 = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $checkpoint1;
}

function getcheckpoint1ById(int $id): array|false
{
    $connection = createConnection();

    $query = 'SELECT id,title, description FROM checkpoint1 WHERE id=:id';
    $statement = $connection->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $checkpoint1 = $statement->fetch(PDO::FETCH_ASSOC);

    return $checkpoint1;
}

function savecheckpoint1(array $checkpoint1): void
{
    $connection = createConnection();

    $query = 'INSERT INTO checkpoint1(title, description) VALUES (:title, :description)';
    $statement = $connection->prepare($query);
    $statement->bindValue(':title', $checkpoint1['title'], PDO::PARAM_STR);
    $statement->bindValue(':description', $checkpoint1['description'], PDO::PARAM_STR);
    $statement->execute();
}
// DELETE FROM checkpoint1 WHERE id = :id;
function deletecheckpoint1ById(int $id) : void 
{
    $connection = createConnection();
    $query = 'DELETE FROM checkpoint1 WHERE id=:id';
    $statement = $connection->prepare($query);
    $statement->bindValue(':id', $id,PDO::PARAM_INT);
    $statement->execute();
}

// UPDATE checkpoint1 SET title = :title, description = :description WHERE id = :id; (つ▀¯▀)つ 
function updateReceipeById(int $id, string $title, string $description): void
{
 $connection = createConnection();
 $query = 'UPDATE checkpoint1 SET title=:title, description=:description WHERE id=:id';
 $statement = $connection->prepare($query);
 $statement->bindValue(':id', $id,PDO::PARAM_INT);
 $statement->bindValue(':title', $title, PDO::PARAM_STR);
 $statement->bindValue(':description', $description, PDO::PARAM_STR);
 $statement->execute();
}









