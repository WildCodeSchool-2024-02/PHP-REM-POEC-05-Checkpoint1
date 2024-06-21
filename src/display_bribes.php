<?php
require __DIR__ .'/../connec.php';
$conn = new PDO(DSN, USER, PASS);



$sql = 'SELECT name, payment FROM bribe ORDER BY name';
$stmt = $conn->prepare($sql);
$stmt->execute();


$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total =0;


if(count($results) > 0){
    echo "<table>";
    echo "thead><tr><th>Name</th><th>Payment</th><th></thead>";
    echo "<tbody>";
    foreach($results as $row){
        echo "<tr><td>" . ($row["name"]) . "</td><td>" . ($row["payment"]) . "</td><td>";
        $total += $row["payment"];
    }
    echo "<tbody>";
    echo "<tfoot><tr><td>Total</td><td>" . $total . "</td></tr></tfoot>";
    echo "<table>";

}else{
    echo "0 results";
}