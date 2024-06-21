<?php
require 'connec.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $payment = $_POST['payment'];

    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (empty($payment) || $payment <= 0) {
        $errors[] = "Payment must be greater than 0.";
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO bribe (name, payment) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $payment);
        $stmt->execute();
        $stmt->close();
        header("Location: index.php");
        exit();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Bribe</title>
</head>
<body>
    <h1>Add a Bribe</h1>
    <?php if (!empty($errors)) : ?>
        <div class="errors">
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <form method="post" action="add_bribe.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="payment">Payment:</label>
        <input type="number" id="payment" name="payment" required>
        
        <button type="submit">Add Bribe</button>
    </form>
</body>
</html>
