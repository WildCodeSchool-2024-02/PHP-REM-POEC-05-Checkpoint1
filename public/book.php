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
            <img src="image/whisky.png" alt="a whisky glass" class="whisky" />
            <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky" />

            <div class="pages-pen">
                <div class="pages">
                    <div class="page leftpage">
                        Add a bribe
                        <!-- TODO : Form -->
                    </div>

                    <div class="page rightpage">
                        <!-- TODO : Display bribes and total paiement -->
                        <!-- <h1>Liste des pots-de-vin</h1>
                        <table>
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Paiement</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($bribes)) : ?>
                                    <?php foreach ($bribes as $bribe) : ?>
                                        <tr>
                                            <td><?= $bribe['name']; ?></td>
                                            <td><?= $bribe['payment']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="2">Aucune donnée disponible</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Total</td>
                                    <td><?= $totalPayment; ?></td>
                                </tr>
                            </tfoot>
                        </table> -->
                    </div>
                </div>
                <img src="image/inkpen.png" alt="an ink pen" class="inkpen" />
            </div>
        </section>
    </main>
</body>

</html>