<?php
$total = 0;
foreach ($brides as $payment) {
    $total += $payment['payment'];
}

$errors = addBride();
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
        <img src="image/whisky.png" alt="a whisky glass" class="whisky"/>
        <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky"/>

        <div class="pages">
            <div class="page leftpage">
                <h1>Add a bribe</h1>

                <?php foreach ($errors as $error) : ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>

                <form action="" method="post" class="form">
                    <div>
                        <label for="name">Name</label>
                        <input id="name" name="name" type="text" value="<?= $bride['name'] ?? '' ?>">
                    </div>
                    <div>
                        <label for="payment">Payment</label>
                        <input type="number" id="payment" name="payment" value="<?= $bride['payment'] ?? '' ?>">
                    </div>
                    <button>Send</button>
                </form>
            </div>

            <div class="page rightpage">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($brides as $bride) : ?>
                            <tr>
                                <td><?= $bride['name'] ?></td>
                                <td><?= $bride['payment'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Total</th>
                        <th><?php echo $total; ?>€</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
    </section>
</main>
</body>
</html>
