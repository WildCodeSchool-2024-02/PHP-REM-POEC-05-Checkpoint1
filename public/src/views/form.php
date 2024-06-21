<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/book.css">
    <title>Checkpoint PHP 1</title>
</head>
<body>

<?php include 'header.php'; ?>

<main class="container">

    <section class="desktop">
        <img src="image/whisky.png" alt="a whisky glass" class="whisky"/>
        <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky"/>

        <div class="pages">
            <div class="page leftpage">
                Add a bribe
                <!-- TODO : Form -->
            </div>

            <div class="page rightpage">
                <!-- TODO : Display bribes and total paiement -->
                <form method="post" action="add_bribe.php">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
    
                    <label for="payment">Payment:</label>
                    <input type="number" id="payment" name="payment" required>
    
                    <button type="submit">Add Bribe</button>
                </form>

            </div>
        </div>
        <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
    </section>
</main>
</body>
</html>
