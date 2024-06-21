<?php
    require_once '../connec.php';

    function createConnection(): PDO
    {
        return new PDO("mysql:host=" . SERVER . ";dbname=" . DATABASE . ";charset=utf8", USER, PASSWORD);
    }

    function _initIndex():array{
        $index = array();
        foreach(range('A','Z') as $i) {
            $index[$i] = [];
        }
        return $index;
      }
    function indexLetters():array{
        $index = _initIndex();
        $connection = createConnection();
        $statement = $connection->query('SELECT * FROM bribe order by name');
        $bribes = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach($bribes as $bribe =>$info)
        {
            array_push($index[strtoupper(substr($info['name'], 0, 1))], array('id' => $info['id'],'name' => $info['name'], 'payment' =>$info['payment']));
        }
         
        return $index;
	}

    function firstLetterBribe($index):array{
        foreach($index as $letter)
        {
            if(count($letter)>0)
            {
                return $letter;
            }
        }
        return $index;
    }

    $connection = createConnection();
    $paymentStatement = $connection->query('SELECT SUM(payment) from bribe;');
    $totalPayment = $paymentStatement->fetch()[0];
    $index = indexLetters();
    $bribes = firstLetterBribe($index);
    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        $payments = array_map('trim', $_POST);
    
        // Validate data
        if (empty($payments['name'])) {
            $errors[] = 'Name required.';
        }
        if (empty($payments['payment'])) {
            $errors[] = 'payment required.';
        }
        if (!empty($payments['payment'])<=0) {
            $errors[] = 'bribe should be higher than 0.';
        }
    
        // Save the recipe
        if (empty($errors)) {
            $connection = createConnection();
            $query = 'INSERT INTO bribe(name, payment) VALUES(:name, :payment)';
            $statement = $connection->prepare($query);
            $statement->bindValue(':name', $payments['name'], PDO::PARAM_STR);
            $statement->bindValue(':payment', $payments['payment'], PDO::PARAM_INT);
            $statement->execute();
            header('Location: /book.php');
        }
        else
        {
            session_start();
            $_SESSION['errors']=$errors;
        }
    }

    if($_SERVER["REQUEST_METHOD"] === 'GET')
    {
        if(!empty($_GET['L'])&&strlen($_GET['L'])==1)
        {
            $bribes=$index[trim($_GET['L'])];
            var_dump($bribes);
            $payment=0;
            foreach($bribes as $bribe=>$info)            
            {
                $payment+=$info['payment'];
            }
            $totalPayment=$payment;
        }
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
    <section class="index">
        <?php foreach($index as $id => $brides): ?>
            <a href="book.php?L=<?= $id?>"> <?= $id ?></a>
        <?php endforeach; ?>
    </section>
    <section class="desktop">
        <img src="image/whisky.png" alt="a whisky glass" class="whisky"/>
        <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky"/>

        <div class="pages">
            <div class="page leftpage">
                <?php if(session_status() == PHP_SESSION_ACTIVE && array_key_exists('errors', $_SESSION)): ?>            
                    <h3> hey boss, you wrote an error in the book !</h3>
                    <ul>
                        <li>
                        <?= implode('<li>', $_SESSION['errors']); ?>
                    </ul>        
                <?php endif; ?>
                Add a bribe
                <!-- TODO : Form -->
                <form action="" method="post">
                    <div>
                        <label for="name">name :</label>
                        <input id="name" name="name" type="text">
                    </div>
                    <div>
                        <label for="payment">payment :</label>
                        <input id="payment" name="payment" type="text">
                    </div>
                    <button>🖊</button>
                </form>
            </div>

            <div class="page rightpage">
                <!-- TODO : Display bribes and total paiement -->
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($bribes as $bribe => $info): ?>
                            <tr>
                                <th><?= $info['name'] ?></th>
                                <td><?= $info['payment'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                        <th scope="row">Totals</th>
                        <td><?= $totalPayment ?></td>
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