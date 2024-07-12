<?php
// Start session
session_start();

// Check if the user is logged in
if(!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit; // Ensure script stops execution after redirect
}

// Database credentials
include 'connect.php';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data based on ID
$id = $_GET['id'];
$sql = "SELECT * FROM orders WHERE order_id = $id";
$result = $conn->query($sql);

// Initialize variables
$product_id = "";
$quantity = "";
$status = "";

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $order_id = $row['order_id'];
    $quantity = $row['quantity'];
    $status = $row['status'];
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Item -  Book Store</title>
<link rel="shorcut icon" type="x-icon" href="https://i.ibb.co/VgPWV0q/judith.png">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Order</h2>
    <form action="update-order.php" method="post">
        <div class="form-group">
            <label for="product_id">Product ID:</label> 
            <input type="number" class="form-control" id="product_id" name="product_id" value="<?php echo $order_id; ?> " hidden>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $quantity; ?>">
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status">
                <option value="1" <?php if($status == 1) echo "selected"; ?>>Pending</option>
                <option value="2" <?php if($status == 2) echo "selected"; ?>>Processing</option>
                <option value="3" <?php if($status == 3) echo "selected"; ?>>Shipped</option>
                <option value="4" <?php if($status == 4) echo "selected"; ?>>Out for Delivery</option>
                <option value="5" <?php if($status == 5) echo "selected"; ?>>Delivered</option>
                <option value="6" <?php if($status == 6) echo "selected"; ?>>Delayed</option>
                <option value="7" <?php if($status == 7) echo "selected"; ?>>Cancelled</option>
                <option value="8" <?php if($status == 8) echo "selected"; ?>>Returned</option>
            </select>
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="admin-orders.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

</body>
</html>
