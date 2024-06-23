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

    <?php include 'header.php';
    require_once("../connec.php");
    include 'method.php'; ?>

    <main class="container">

        <section class="desktop">
            <img src="image/whisky.png" alt="a whisky glass" class="whisky" />
            <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky" />

            <div class="pages">
                <div class="page leftpage">
                    <?php foreach ($errors as $error) : ?>
                        <p><?= $error ?></p>
                    <?php endforeach; ?>
                    Add a bribe
                    <form action="" method="post">
                        <div>
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name">
                        </div>
                        <div>
                            <label for="payment">Payment</label>
                            <input type="text" id="payment" name="payment">
                        </div>
                        <div>
                            <input type="submit" value="Add to the book">
                        </div>
                    </form>
                </div>

                <div class="page rightpage">
                    <!-- TODO : Display bribes and total paiement -->
                    <table>
                        <tbody>

                            <?php foreach ($bribes as $bribe) : ?>
                                <tr>
                                    <th><?= $bribe['name'] ?></th>
                                    <td><?= $bribe['payment'] ?>€</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <td> <?php
                                        $sum = 0;
                                        foreach ($bribes as $bribe) {
                                            $sum += $bribe['payment'];
                                        }
                                        echo ($sum) ?>€ </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <img src="image/inkpen.png" alt="an ink pen" class="inkpen" />
        </section>
    </main>
</body>

</html>