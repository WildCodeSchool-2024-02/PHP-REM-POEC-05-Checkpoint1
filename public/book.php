<?php
    require_once '../connec.php';

    function createConnection(): PDO
    {
        return new PDO("mysql:host=" . SERVER . ";dbname=" . DATABASE . ";charset=utf8", USER, PASSWORD);
    }

    function _initIndex():array{
        $index = array();
        foreach(range('A','Z') as $i) {
            $index[$i] = array();
        }
        return $index;
      }

    function indexLetters($bribes):array{
        $index = _initIndex();

        foreach($bribes as $bribe =>$info)
        {
            array_push($index[strtoupper(substr($info['name'], 0, 1))], array('id' => $info['id'],'name' => $info['name'], 'payment' =>$info['payment']));
        }         
        return $index;
	}

    $connection = createConnection();
    $statement = $connection->query('SELECT * FROM bribe order by name');
    $all = $statement->fetchAll(PDO::FETCH_ASSOC);
    $bribes=$all;
    $paymentStatement = $connection->query('SELECT SUM(payment) from bribe;');
    $totalPayment = $paymentStatement->fetch()[0];
    $index = indexLetters($all);


    /*  
        ========================================= FORM control =========================
    */
    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        $payments = array_map('trim', $_POST);
    
        // Validate data
        if (empty($payments['name'])) {
            $errors[] = 'Name required.';
        }
        if (empty($payments['payment'])) {
            $errors[] = 'payment required.';
        }
        if(preg_match("/^[A-Za-zÀ-ÖØ-öø-ÿ ]+$/", $_POST['name'])<1)
        {
            $errors[] = 'forbiden characters in name';
        }
        if (filter_var($payments['payment'], FILTER_VALIDATE_INT)<=0) {
            $errors[] = 'bribe should be higher than 0.';
        }
        if(strtoupper($payments['name'])==="ELIOTT NESS")
        {
            $errors[] ='This man is untouchable';
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

    /*  
        ========================================= Index control =========================
    */
    if($_SERVER["REQUEST_METHOD"] === 'GET' && isset($_GET['letter']))
    {
        $letter=trim(strtoupper($_GET['letter']));
        if(!empty($letter)&&strlen($letter)==1 && preg_match('/[A-Z]/',$letter)>=1)
        {
            $bribes=$index[$letter];
            $payment=0;
            foreach($bribes as $bribe=>$info)            
            {
                $payment+=$info['payment'];
            }
            $totalPayment=$payment;
        }
    }
    else
    {
        $bribes=$all;
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
            <?php if(count($brides)>0):?>
                <a href="book.php?letter=<?= $id?>"> <?= $id ?></a>
                <?php else: ?>
                    <p><?= $id ?></p>
            <?php endif; ?>
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
                        <label for="name">Name :</label>
                        <input id="name" name="name" type="text">
                    </div>
                    <div>
                        <label for="payment">Payment :</label>
                        <input id="payment" name="payment" type="text">
                    </div>
                    <button>🖊</button>
                </form>
            </div>

            <div class="page rightpage">
                    <?php if(isset($_GET['letter'])&& strlen($_GET['letter'])==1) : ?>
                        <h3><?= trim(mb_strtoupper($_GET['letter'])) ?></h3>
                    <?php endif; ?>
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
                                <td><?= $info['payment'] ?> $</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                        <th scope="row">Total</th>
                        <td><?= $totalPayment ?> $</td>
                        </tr>
                    </tfoot>
                </table>
                <a href="book.php">show All </a>
            </div>
        </div>
        <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
    </section>
</main>
</body>
</html>