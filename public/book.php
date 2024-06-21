<?php
require_once __DIR__ . '/../connec.php';
// require __DIR__ . '/../src/controllers/payment-controller.php';
// $payments = showPayment();
require_once 'treatment.php';
?>
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

            <div class="pages">
                <div class="page leftpage">
                    Add a bribe
                    <!-- TODO : Form -->
                </div>

                <div class="page rightpage">
                    <!-- TODO : Display bribes and total paiement -->
                <?php // require_once __DIR__ . '/../src/views/payment-view.php' ?>
                <?php var_dump(getAllPayments()); ?>
                </div>
            </div>
            <div class="inkdiv">
                <img src="image/inkpen.png" alt="an ink pen" class="inkpen" />
            </div>
        </section>
    </main>
</body>

</html>