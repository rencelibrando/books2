<?php
// Start session
session_start();

// Database credentials
include 'connect.php';
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user_id'];
$date = date("Y-m-d H:i:s");

// Retrieve form data
$prid = $_POST['product_id'];
$quantity = intval($_POST['quantity']);
$prc = intval($_POST['product_price']);
$payment_method = $_POST['payment_method'];
$transaction = $_POST['transaction'];
$cart_id = $_POST['cart_id'];
$location = $_POST['location'];
$contactNumber = $_POST['contactNumber'];
$stats = 1;

// Perform the calculation
$price = $quantity * $prc;

// Insert order data into the database
$sql = "INSERT INTO orders (user_id, product_id, quantity, status, payment, transac, contact, address, created_at) VALUES ('$user', '$prid', '$quantity', '$stats', '$payment_method', '$transaction', '$contactNumber', '$location', '$date')";

if ($conn->query($sql) === TRUE) {
    // Order insertion successful
    // Update the active status of the cart item to 1
    $sql_update = "UPDATE carts SET active = 1 WHERE cart_id = '$cart_id' AND user_id = '$user' AND active = 0";
    if ($conn->query($sql_update) === TRUE) {
        // Update successful
        echo "Order placed successfully! Redirecting to receipt page...";
        header("Location: orders.php");
        exit();
    } else {
        // Update failed
        echo "Error updating cart: " . $conn->error;
    }
} else {
    // Order insertion failed
    echo "Error inserting order: " . $conn->error;
}

// Close database connection
$conn->close();
?>
