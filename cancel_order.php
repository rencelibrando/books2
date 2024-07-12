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

// Check if order ID is set in the URL
if (isset($_GET['id'])) {
    $order_id = (int)$_GET['id'];

    // Prepare and execute delete query
    $stmt = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);

    if ($stmt->execute()) {
        // Redirect to orders page after deletion
        header("Location: admin-orders.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    // Redirect to orders page if no order ID is set
    header("Location: admin-orders.php");
    exit;
}

// Close connection
$conn->close();
?>
