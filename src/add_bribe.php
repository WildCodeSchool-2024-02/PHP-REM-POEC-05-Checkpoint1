<?php
require_once __DIR__ .'/../connec.php';

$conn = new PDO(DSN, USER, PASS);


$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $payment = isset($_POST['payment']) ? trim($_POST['payment']) : '';

    // Validation des données
    if (empty($name)) {
        $errors[] = "The name must not be empty.";
    }
    if (empty($payment) || $payment <= 0) {
        $errors[] = "Payment must be greater than 0.";
    }

    if (empty($errors)) {
        
        $sql = "INSERT INTO bribe (name, payment) VALUES (:name, :payment)";
        $statement = $conn->prepare($sql);

      
        $statement->bindValue(':name', $name, PDO::PARAM_STR);
        $statement->bindValue(':payment', $payment, PDO::PARAM_INT);

 
        if ($statement->execute()) {
         
            header("Location: index.php");
            exit;
        } else {
            $errors[] = "Error when adding the bribe !";
        }
    }
}
?>
 
<section class="form-container" id="contact">
    <?php if (!empty($errors)) : ?>
        <div class="errors">
        <h3>Please fix errors below</h3>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
        </div>
    <?php endif; ?>
  
    <form action="" method="post">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" >

        <label for="payment">Payment</label>
        <input type="number" id="payment" name="payment" ></input>


        <input type="submit" value="Envoyer">
    </form>
</section>
 
 
