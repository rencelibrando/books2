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

// Check if product_id is set in the URL
if (isset($_GET['product_id'])) {
    // Database credentials
    

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get product_id from URL
    $product_id = $_GET['product_id'];

    // Prepare SQL statement to delete the item from the carts table
    $sql = "DELETE FROM carts WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($sql);

    // Bind parameters and execute statement
    $stmt->bind_param("ii", $_SESSION['user_id'], $product_id);

    if ($stmt->execute()) {
        // Item deleted successfully
        echo "Item canceled successfully.";
        header("refresh:2;url=cart.php");
    } else {
        // Error occurred while deleting item
        echo "Error canceling item: " . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect to cart page if product_id is not set in the URL
    header("Location: cart.php");
    exit; // Ensure script stops execution after redirect
}
?>