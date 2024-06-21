<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/public:css/main.css">
    <link rel="stylesheet" href="public/css/book.css">
    <title>Checkpoint PHP 1</title>
</head>
<body>

<?php include 'header.php'; ?>

<main class="container">

<!--Screenshot > 1200px -->
<section class="container2">
            <div class="articles">            
                   <img src="image/whisky.png" alt="a whisky glass" class="whisky"/>           
                <article>
                    <div class="pages">
                        <div class="page leftpage">
                            Add a bribe
                              <!-- TODO : Form -->
                        </div>
                        <div class="page rightpage">
                               <!-- TODO : Display bribes and total paiement -->
                        </div>
                    </div>
                </article>
                <article>
                <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
              </article>
            </div>
        </section>

        <section class="bribes">
        <h1>List of bribes</h1>
        <ul>
            <?php foreach ($bribes as $bribe) : ?>
                <li>
                    <a href="show?id=<?= $bribe['id'] ?>">
                        <?= $recipe['nom'] ?>
                        <?= $recipe['payement'] ?>
                    </a>
                </li>
            <?php endforeach ?>
        </ul>
            </section>
    </main>    




        </main>
</body>
</html>



