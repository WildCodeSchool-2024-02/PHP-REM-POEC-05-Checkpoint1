<?php
require __DIR__ . '/../models/checkpoint1-model.php';

function browsecheckpoint1(): void
{
    $checkpoint1 = getAllcheckpoint1();
    require __DIR__ . '/../views/indexcheckpoint1.php';
}

function showcheckpoint1(int $id): void
{
    if (empty($id)) {
        die("Wrong input parameter");
    }
    $checkpoint1 = getcheckpoint1ById($id);

    // Database result check
    if (!isset($checkpoint1['title']) || !isset($checkpoint1['description'])) {
        header("HTTP/1.1 404 Not Found");
        die("checkpoint1 not found");
    }

    // Generate the web page
    require __DIR__ . '/../views/showcheckpoint1.php';
}

function addcheckpoint1(): void
{
    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        $checkpoint1 = array_map('trim', $_POST);

        // Validate data
        if (empty($checkpoint1['title'])) {
            $errors[] = 'The title is required';
        }
        if (empty($checkpoint1['description'])) {
            $errors[] = 'The description is required';
        }
        if (!empty($checkpoint1['title']) && strlen($checkpoint1['title']) > 255) {
            $errors[] = 'The title should be less than 255 characters';
        }

        // Save the checkpoint1
        if (empty($errors)) {
            savecheckpoint1($checkpoint1);
            header('Location: /');
        }
    }

    // Generate the web page
    require __DIR__ . '/../views/form.php';
}

function updatecheckpoint1($id): void
{
    $errors = [];
    if (empty($id)) {
        die("Wrong input parameter");
    }
    $checkpoint1 = getcheckpoint1ById($id);
    // Database result check
    if (!isset($checkpoint1['title']) || !isset($checkpoint1['description'])) {
        header("HTTP/1.1 404 Not Found");
        die("checkpoint1 not found");
    }

    if ($_SERVER["REQUEST_METHOD"] === 'POST') {

        $checkpoint1 = array_map('trim', $_POST);

        if (empty($checkpoint1['title'])) {
            $errors[] = 'The title is required';
        }
        if (empty($checkpoint1['description'])) {
            $errors[] = 'The description is required';
        }
        if (!empty($checkpoint1['title']) && strlen($checkpoint1['title']) > 255) {
            $errors[] = 'The title should be less than 255 characters';
        }

        if (empty($errors)) {
            updateReceipeById($checkpoint1['id'], $checkpoint1['title'], $checkpoint1['description']);
            header('Location: /');
        }
    }
    //corrigé il manquais un e//  
    require __DIR__ . '/../views/updateReceipe.php';
}
