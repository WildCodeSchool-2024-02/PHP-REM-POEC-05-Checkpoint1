<?php
include '../connec.php';
$connection = new PDO(DSN, USER, PASS);
$errors = [];
$letters=range('A','Z'); //Va créer automatiquement un tableau avec les lettres de A à Z

if ('POST' === $_SERVER['REQUEST_METHOD']) {
    //On trim (-retire les espaces des entrées de POST et on stocke dans datas)
    $datas = array_map('trim', $_POST);
    if (empty($datas['name']) || strlen($datas['name'])===0) {
        $errors[] = 'Veuillez saisir un nom';
    }
    //On vérifie si le montant est bien présent, est un chiffre, et supérieur à 0
    if (empty($datas['payment']) || is_null(filter_var($datas['payment'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE)) || $datas['payment'] <= 0) {
        $errors[] = 'Veuillez saisir une valeur valide';
    }

    //Bonus : on evite une note à Eliott Ness, en prenant en ne tenant pas compte des majuscules
    if(strtoupper($datas['name'])==='ELIOT NESS') {
        $errors[] = 'This man is untouchable';
    }
    if (empty($errors)) {
        $name = $datas['name'];
        $payment = $datas['payment'];
        $query = "INSERT INTO bribe (name, payment) VALUES (:name, :payment)";
        $st = $connection->prepare($query);
        $st->bindValue(':name', $name, PDO::PARAM_STR);
        $st->bindValue(':payment', $payment, PDO::PARAM_INT);
        $st->execute();
        header('Location: book.php');
    }
}
if(!empty($_GET['letter'])) {
    $query = "SELECT name, payment FROM bribe WHERE UPPER(name) LIKE :letter ORDER BY name";
    $st = $connection->prepare($query);
    $st->bindValue(':letter', $_GET['letter']. '%', PDO::PARAM_STR);
    $st->execute();
} else {
    $query = "SELECT name, payment FROM bribe  ORDER BY name";
    $st = $connection->query($query);
}
$payments = $st->fetchAll();
$total = 0;
foreach ($payments as $payment) {
    $total += $payment['payment'];
}
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
        <!-- Affichage du répertoire -->
        <div class="repertoire">
                    <?php foreach( $letters as $letter) :?>
                    <a href="?letter=<?=$letter ?>" class="letter"><?=$letter ?></a>
                    <?php endforeach; ?>
                </div>
        
        <section class="desktop">
            <img src="image/whisky.png" alt="a whisky glass" class="whisky" />
            <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky" />

            <div class="pages">
                <div class="page leftpage">
                    Add a bribe
                    <!-- TODO : Form -->
                    <?php foreach ($errors as $error) : ?>
                        <p><?= $error ?></p>
                    <?php endforeach; ?>
                    <form action="" method="post">
                        <div class="input">
                            <label for="name">Nom : </label>
                            <input type="text" name="name" id="name" class="inputs">
                        </div>
                        <div class="input">
                            <label for="name">Paiement : </label>
                            <input type="text" name="payment" id="payment" class="inputs">
                        </div>
                        <button>Valider</button>
                    </form>
                </div>

                <div class="page rightpage">
                    <!-- Si on a filtrer, on affiche la lettre -->
                    <?php if(!empty($_GET['letter']))  : ?>
                        <p class="letter-search"><?=htmlentities($_GET['letter'])?></p>
                    <?php endif; ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Payment</th>
                            </tr>
                        </thead>
                        <!-- TODO : Display bribes and total paiement -->
                        <?php foreach ($payments as $payment) : ?>
                            <tr>
                                <td><?= htmlentities($payment['name']) ?></td>
                                <td><?= $payment['payment'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <td><?= $total ?></td>
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