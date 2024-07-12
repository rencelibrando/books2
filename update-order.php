<?php
// Start session
session_start();


include 'connect.php';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    $status = $_POST['status'];

    // Prepare update query
    $sql = "UPDATE orders SET quantity = '$quantity', status = '$status' WHERE order_id = '$id'";

    if ($conn->query($sql) === TRUE) {
        // Redirect to admin orders page after successful update
        header("Location: admin-orders.php");
        exit();
    } else {
        // Error handling
        echo "Error updating record: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>
