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
            <div class="image-whisky">
                <img src="image/whisky.png" alt="a whisky glass" class="whisky" />
            </div>
            <div class="image-whisky">

                <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky" />
            </div>

            <div class="pages">
                <div class="page leftpage">
                    Add a bribe
                    <!-- TODO : Form -->
                </div>

                <div class="page rightpage">
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Payment</th>
                        </tr>
                        <?= require  'src/controllers/bribes-controller.php'; ?>
                        <?= $bribes = browseBribes(); ?>

                        <?php foreach ($bribes as $bribe) : ?>

                            <tr>
                                <td><?= $bribe["name"] ?></td>
                                <td><?= $bribe["payment"] ?></td>
                            </tr>

                        <?php endforeach ?>

                    </table>
                </div>
            </div>
            <img src="image/inkpen.png" alt="an ink pen" class="inkpen" />
        </section>
    </main>
</body>

</html>