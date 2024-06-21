<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>ajouter un crediteur</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    </head>
    <body>
        <main class="container">
            <a href="/liste">Home</a>
            <h1>ajouter un crediteur</h1>

            <?php foreach ($errors as $error) : ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>

            <form action="" method="post">
                <div>
                    <label for="name">Nom</label>
                    <input id="name" name="name" type="text" value="<?= $book['name'] ?? '' ?>">
                </div>
                <div>
                    <label for="payment">payment</label>
                    <input id="payment" name="payment" type="number" value="<?= $book['payment'] ?? '' ?>">
                </div>
                <button>Send</button>
            </form>
        </main>
    </body>
</html>