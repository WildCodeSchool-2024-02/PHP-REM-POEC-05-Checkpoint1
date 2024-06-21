<?php

require __DIR__ . '/../models/book-model.php';

function home(): void
{
    require __DIR__ . '/../views/home.php';
}

function browseBook(): void
{
    $brides = getAllBrides();
    require_once __DIR__ . '/../views/showBook.php';
}

function addBride(): array
{
    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        $bride = array_map('trim', $_POST);

        // Validate data
        if (empty($bride['name'])) {
            $errors[] = 'The name is required';
        }
        if (empty($bride['payment']) && $bride['payment'] < 0) {
            $errors[] = 'The payment is required and must be greater than 0.';
        }
        if (!empty($bride['name']) && strlen($bride['name']) > 255) {
            $errors[] = 'The name should be less than 255 characters';
        }

        // Save the recipe
        if (empty($errors)) {
            saveBride($bride);
            header('Location: /book');
        }
    }

    return $errors;
}
