<?php


require 'connec.php';

$sql = "SELECT name, payment FROM bribe ORDER BY name";
$result = $conn->query($sql);

$totalPayment = 0;

if ($result->num_rows > 0) {
    echo "<table><thead><tr><th>Name</th><th>Payment</th></tr></thead><tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["name"] . "</td><td>" . $row["payment"] . "</td></tr>";
        $totalPayment += $row["payment"];
    }
    echo "</tbody><tfoot><tr><td>Total</td><td>" . $totalPayment . "</td></tr></tfoot></table>";
} else {
    echo "0 results";
}

$conn->close();
?>
