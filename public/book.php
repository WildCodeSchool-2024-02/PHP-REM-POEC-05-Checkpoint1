<?php
// Fichier de connexion à la base de données
require '../connec.php';

// Connexion à la base de données
$pdo = new PDO(DSN, USER, PASS);
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

        <div class="alphabetical-index">
            <!-- On va gérer l'affichage en fonction de l'index alphabetic -->

            <?php 
            // Requete SQL pour extraire les noms de la base de donnée
            $sql = "SELECT name FROM bribe order by name";
            $result = $pdo->query($sql);

            //  On stock les noms dans un tableau
            $letters = [];

            // On parcours les noms
            if ($result->rowCount() > 0) {
                while ($row = $result->fetch()) {
                    // Extraction de la première lettre du nom
                    $name = $row['name'];
                    $firstLetter = strtoupper($name[0]);
                    // Ajout de la lettre dans le tableau si elle n'existe pas
                    if (!in_array($firstLetter, $letters)) {
                        $letters[] = $firstLetter;
                    }
                }
            }
            ?>

            <?php foreach ($letters as $letter) : ?>
                <a href="#<?= $letter ?>"><?= $letter ?></a>
            <?php endforeach; ?>
        </div>

        <section class="desktop">
            <img src="image/whisky.png" alt="a whisky glass" class="whisky" />
            <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky" />

            <div class="pages">
                <div class="page leftpage">
                    <!-- Verification des données du formulaire -->
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                        // Sécrurisation des données
                        $name = htmlentities(trim($_POST['name']));
                        $payment = htmlentities(trim($_POST['payment']));

                        // Validation des données saisies
                        $errors = [];

                        if (empty($name)) {
                            $errors[] = 'Name is required';
                        }

                        if (empty($payment)) {
                            $errors[] = 'Payment is required';
                        }

                        if (!is_numeric($payment) || $payment <= 0) {
                            $errors[] = 'Payment must be a positif number';
                        }

                        // Si il n'y a pas d'erreur on ajoute le paiement
                        if (empty($errors)) {
                            $query = "INSERT INTO bribe (name, payment) VALUES (:name, :payment)";
                            $statement = $pdo->prepare($query);
                            $statement->bindValue(':name', $name, PDO::PARAM_STR);
                            $statement->bindValue(':payment', $payment, PDO::PARAM_INT);
                            $statement->execute();
                        } else {
                            // Sinon on affiche les erreurs
                            foreach ($errors as $error) {
                                echo "<p class='error'>$error</p>";
                            }
                        }
                    }
                    ?>

                    <!-- Affichage des erreurs -->
                    <?php if (!empty($errors)) : ?>
                        <div class="error-form">
                            <?php foreach ($errors as $error) : ?>
                                <h3>Nous rencontrons les erreurs suivantes</h3>
                                <ul>
                                    <li><?= $error ?></li>
                                </ul>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    Add a bribe
                    <!-- Form to add bribe -->
                    <form action="" method="post">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" required>
                        <label for="payment">Payment</label>
                        <input type="number" class="input-payement" name="payment" id="payment" required>
                        <button type="submit">Add</button>
                    </form>
                </div>

                <div class="page rightpage">
                    <!-- Display bribes and total paiement -->
                    <?php
                    // On affiche les paiements ordonnés par nom
                    $query = "SELECT * FROM bribe ORDER BY name";
                    $statement = $pdo->query($query);
                    $payements = $statement->fetchAll(PDO::FETCH_ASSOC);

                    ?>

                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Payment</th>
                            </tr>
                        </thead>
                        <?php foreach ($payements as $payement) : ?>
                            <tr>
                                <td><?= $payement['name'] ?></td>
                                <td><?= $payement['payment'] ?></td>
                            </tr>
                        <?php endforeach; ?>

                        <tfoot>
                            <tr>
                                <td class="bold-important">Total</td>
                                <td class="bold-important bd-top">
                                    <?php
                                    // On calcule le total des paiements
                                    $query = "SELECT SUM(payment) as total FROM bribe";
                                    $statement = $pdo->query($query);
                                    $total = $statement->fetch(PDO::FETCH_ASSOC);
                                    echo $total['total'];
                                    ?>
                                </td>
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