<?php
// Start session

session_start();

include 'connect.php';
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit; // Ensure script stops execution after redirect
}

$user = $_SESSION['user_id'];

// Check if the form was submitted for buying now
if (isset($_POST['buy_now'])) {
    // Get product ID and quantity from the form
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Process payment here (you can add code for payment processing)

    // Update stock quantity in the database
    $update_sql = "UPDATE stock SET quantity = quantity - $quantity WHERE product_id = $product_id";
    $conn->query($update_sql);
}

// Redirect back to cart page after processing
header("Location: cart.php");
exit;
?>
