<?php 

$firstname = $_POST['Firstname'];
$payment = $_POST['payment'];


$valueToAdd = array($firstname,$payment);

$fp = fopen('contact.csv','a+');

    fputcsv($fp, $valueToAdd);
    
fclose($fp);


if ( isset( $_POST["submit"] ) && !empty($firstname) && !empty($payment) ) {
    // (deal with the submitted fields here) 
    header( "Location: redirection.php " );
    exit();     
  } else {
// (deal with the submitted unfields here)
header( "Location: thanks.php" );
} 