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

<!--Screenshot > 1200px -->
<section class="container2">
            <div class="articles">            
                   <img src="image/whisky.png" alt="a whisky glass" class="whisky"/>           
                <article>
                    <div class="pages">
                        <div class="page leftpage">
                            Add a bribe
                              <!-- TODO : Form -->
                        </div>
                        <div class="page rightpage">
                               <!-- TODO : Display bribes and total paiement -->
                        </div>
                    </div>
                </article>
                <article>
                <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
              </article>
            </div>
</section>
<section class="bribes">
<h1>Bribes</h1>
<?php

//include("checkpoint1.sql");





$host = "localhost";
$username = "Ido";
$password = "Eden2017+";
$db = "checkpoint";
$conn = new PDO("mysql:host=$host;dbname=$db", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {

$query = "SELECT firstname, payment FROM bribe ORDER BY firstname ASC";
$result = $conn->query($query);
?>
<table padding="1" cellpadding="10" cellspacing="0">
<?php
$sn=1;
while($data = $result->fetch(PDO::FETCH_ASSOC)) {
  
  ?>
   <tr>
  <td><?php echo $sn; ?> </td>
  <td><?php echo $data['firstname']; ?> </td>
  <td><?php echo $data['payment']; ?> </td>
   </tr>
   <?php
 }
 ?>
</table>
 <?php
} catch(PDOException $e) {
 echo "Error: " . $e->getMessage();
}

$statement = $connection->query('SELECT SUM(payement) AS total_payement FROM bribe');
$total_payement = $statement->fetch(PDO::FETCH_ASSOC);

?>
</section>
<section>
<h1 class="title">Payment</h1>
        
            <form class="contact" action="payment.php" method="post">
                    <label for="lastname">Firstname*</label>
                    <input class="background-secondary-color" type="text" name="lastname" id="lastname" pattern="([a-zA-Z0-9_\s]+)" required>

                    <label for="firstname">Payment*</label>
                    <input class="background-secondary-color" type="integer" name="firstname" id="firstname" pattern="([a-zA-Z0-9_\s]+)" required>
                    <input class="submit" type="submit" value="confirmer">


            </form>
        
    </section>  







</main>
</body>
</html>
