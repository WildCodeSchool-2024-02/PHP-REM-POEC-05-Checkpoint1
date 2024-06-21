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
    <!-- requetes SQL -->
    <?php
    require_once '../connec.php';
    $pdo = new \PDO(DSN, USER, PASS);

    $query = 'SELECT name, payment FROM bribe ORDER BY name';
    $statement = $pdo->query($query);
    $bribeArray = $statement->fetchAll(PDO::FETCH_ASSOC);

    $query2 = 'SELECT SUM(payment) FROM bribe';
    $statement2 = $pdo->query($query2);
    $totalPaymentArray = $statement2->fetch(PDO::FETCH_ASSOC);
    ?>

    <!-- recuperation formulaire -->
    <?php
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // echo(filter_var($_POST['payment'], FILTER_VALIDATE_INT));
        // var_dump($_POST);
        // var_dump($_POST['payment']);
        // var_dump(filter_var($_POST['payment'],FILTER_VALIDATE_INT));
        // var_dump(filter_var($_POST['payment'],FILTER_VALIDATE_INT)==true);

        if (empty($_POST['name'])) {
            $errors[] = 'Le champ "nom" doit être remplit';
        } else {
            $name = htmlentities(trim($_POST['name']));
        }

        if (!empty(htmlentities(trim($_POST['payment']))) &&  filter_var(htmlentities(trim($_POST['payment'])), FILTER_VALIDATE_INT) && filter_var(htmlentities(trim($_POST['payment'])), FILTER_VALIDATE_INT) > 0) {
            $payment =  filter_var(htmlentities(trim($_POST['payment'])), FILTER_VALIDATE_INT);
        } elseif (empty(htmlentities(trim($_POST['payment'])))) {
            $errors[] = 'Le champ "paiment" doit être remplit';
        } elseif (filter_var(htmlentities(trim($_POST['payment'])), FILTER_VALIDATE_INT) == false ) {
            $errors[] = 'Le champ "paiment" doit être remplit uniquement avec des nombres';
        }elseif (filter_var(htmlentities(trim($_POST['payment'])), FILTER_VALIDATE_INT) < 0) {
            $errors[] = 'Le champ "paiment" doit être remplit avec des nombres supérieurs à 0';
        }

        if (empty($errors)) {
            $pdo = new PDO(DSN, USER, PASS);
            $query = "INSERT INTO  bribe (name, payment) VALUES (:name, :payment)";
            $st = $pdo->prepare($query);
            $st->bindValue(':name', $name, PDO::PARAM_STR);
            $st->bindValue(':payment', $payment, PDO::PARAM_STR);
            $result = $st->execute();


            header('Location: validation.php');
            die();
        }
    }
    ?>



    <!-- appel header -->
    <?php include 'header.php'; ?>

    <main class="container">

        <section class="desktop">
            <div class="glasses">
                <img src="image/whisky.png" alt="a whisky glass" class="whisky" />
                <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky" />
            </div>

            <div class="pages">
                <div class="page leftpage">
                    Add a bribe

                    <?php foreach ($errors as $error) : ?>
                        <p><?= $error ?></p>
                    <?php endforeach ?>
                    <!-- TODO : Form -->
                    <form action="book.php" method="post">

                        <label for="name">Nom</label>
                        <input type="text" id="name" name="name">

                        <label for="payment">Paiement</label>
                        <input type="text" id="payment" name="payment">

                        <input type="submit" value="Valider">

                    </form>
                </div>

                <div class="page rightpage">
                    <!-- TODO : Display bribes and total paiement -->
                    <div>
                        <?php foreach ($bribeArray as $bribe) {
                            echo $bribe['name'] . ' ' . $bribe['payment'] . "<br>";
                        }
                        ?>
                    </div>
                    <tfoot>
                        <?php
                        echo $totalPaymentArray['SUM(payment)'];
                        ?>
                    </tfoot>
                </div>
            </div>
            <div class="pen">
                <img src="image/inkpen.png" alt="an ink pen" class="inkpen" />
            </div>
        </section>
    </main>
</body>


</html>