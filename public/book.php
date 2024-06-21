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
            
        <form action="" method="post">
        <input type="hidden" name="id" value=" <?php echo $bribe['id']; ?>">
        <label for="name">Titre</label>
        <input type="text" id="name" name="name" value="<?php echo $bribee['name']; ?>">
        <label for="payment">Description</label>
        <input type="number" id="description" name="payment" value="<?php echo $bribe['payment']; ?>">
        <input type="submit" value="Enregistrer">
    </form>
</div>

            <div class="page rightpage">
                <!-- TODO : Display bribes and total paiement -->
            </div>
        </div>
        <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
    </section>
</main>
</body>
</html>
