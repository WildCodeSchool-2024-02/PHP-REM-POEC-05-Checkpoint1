<?php
require __DIR__ . '/../models/book-model.php';

function browseBooks(): void
{
    $result = getAllBook();
    $books = $result["books"];
    $total_payment = $result["total_payment"];
    require __DIR__ . '/../views/indexBook.php';
}

function addBook(): void
{
    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        $book = array_map('trim', $_POST);

        // Validate data
        if (empty($book['name'])) {
            $errors[] = 'C Ki Le batard qui te doit du fric ??? ';
        }
        if (empty($book['payment'])) {
            $errors[] = '... il te doit combien ???';
        }
        if (!empty($book['name']) && strlen($book['name']) > 255) {
            $errors[] = 'Eh minio ! ton portefeuille sur pattes a un nom a ralonge .. ';
        }

        // Save the recipe
        if (empty($errors)) {
            
            savebook($book);
            header('Location: /liste');
        }
    }

    // Generate the web page
    require __DIR__ . '/../views/formbook.php';
}