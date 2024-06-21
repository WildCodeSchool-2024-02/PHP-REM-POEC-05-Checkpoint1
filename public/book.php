<?php require __DIR__ . '/../config.php'; ?>
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
    require_once("../config.php");

    $connection = new PDO("mysql:host=" . SERVER . ";dbname=" . DATABASE . ";charset=utf8", USER, PASSWORD);
    $statement = $connection->query('SELECT name,payment FROM bribe');
    $bribes = $statement->fetchAll(PDO::FETCH_ASSOC);


    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        $bribe = array_map('trim', $_POST);

        // Validate data
        if (empty($bribe['name'])) {
            $errors[] = 'The name is required';
        }
        if (empty($bribe['payment'])) {
            $errors[] = 'The payment is required';
        }
        if (!empty($bribe['name']) && $bribe['payment'] < 1) {
            $errors[] = 'The payment should be more than 0 €';
        }

        if (empty($errors)) {
            $query = 'INSERT INTO bribe(name, payment) VALUES (:name, :payment)';
            $statement = $connection->prepare($query);
            $statement->bindValue(':name', $bribe['name'], PDO::PARAM_STR);
            $statement->bindValue(':payment', $bribe['payment'], PDO::PARAM_INT);
            $statement->execute();
            header('Location: book.php');
        }
    }


    ?>

    <main class="container">
        <div class="range">
                <?php $chars = range('A', 'Z',1);
                 foreach ($chars as $char) : ?>
                    <p><a href="?letter=".$char><?= $char ?></a></p>
                <?php endforeach; ?>
            </div>
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
                            <input type="submit" value="Pay !">
                        </div>
                    </form>
                </div>

                <div class="page rightpage">
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
                                <td><?php
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