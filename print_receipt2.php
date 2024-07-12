<?php
// Start session
session_start();
include 'connect.php';
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$quantity = intval($_POST['quantity']);
$product_name = $_POST['product_name'];
$product_price = intval($_POST['product_price']);
$payment_method = $_POST['payment_method'];
$transaction = $_POST['transaction'];
$cart_id = $_POST['cart_id'];
$location = $_POST['location'];
$contactNumber = $_POST['contactNumber'];
$total_price = $quantity * $product_price;

$first_name = ucfirst(strtolower($_SESSION['first_name']));
$last_name = ucfirst(strtolower($_SESSION['last_name']));
$full_name = "$first_name $last_name";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Earist Book Store - Receipt</title>
    <link rel="stylesheet" type="text/css" href="header.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .receipt-container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            max-width: 600px;
            margin: auto;
        }
        .receipt-header {
            border-bottom: 2px solid #000;
            margin-bottom: 20px;
        }
        .receipt-header h1 {
            margin: 0;
            padding: 20px;
            font-size: 28px;
            font-weight: bold;
            color: #333;
        }
        .receipt-details {
            text-align: left;
            margin: 0 auto;
            padding: 20px;
        }
        .receipt-details p {
            margin: 10px 0;
        }
        .receipt-details strong {
            color: #555;
        }
        .receipt-buttons {
            margin-top: 20px;
            text-align: center;
        }
        .receipt-buttons button {
            padding: 10px 20px;
            font-size: 18px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .receipt-buttons button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="receipt-container">
    <div class="receipt-header">
        <h1>Receipt</h1>
    </div>
    <div class="receipt-details">
        <p><strong>Customer Name:</strong> <?php echo htmlspecialchars($full_name); ?></p>
        <p><strong>Product Name:</strong> <?php echo htmlspecialchars($product_name); ?></p>
        <p><strong>Quantity:</strong> <?php echo htmlspecialchars($quantity); ?></p>
        <p><strong>Price per Item:</strong> <?php echo htmlspecialchars($product_price); ?></p>
        <p><strong>Total Price:</strong> <?php echo htmlspecialchars($total_price); ?></p>
        <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($payment_method); ?></p>
        <p><strong>Courier:</strong> <?php echo htmlspecialchars($payment_method); ?></p>
        <p><strong>Transaction:</strong> <?php echo htmlspecialchars($transaction); ?></p>
        <p><strong>Location:</strong> <?php echo htmlspecialchars($location); ?></p>
        <p><strong>Contact Number:</strong> <?php echo htmlspecialchars($contactNumber); ?></p>
        <p><strong>Date:</strong> <?php echo htmlspecialchars(date("Y-m-d H:i:s")); ?></p>
    </div>
    <div class="receipt-buttons">
        <form action="order1.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product_id); ?>">
            <input type="hidden" name="quantity" value="<?php echo htmlspecialchars($quantity); ?>">
            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product_name); ?>">
            <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($product_price); ?>">
            <input type="hidden" name="payment_method" value="<?php echo htmlspecialchars($payment_method); ?>">
            <input type="hidden" name="transaction" value="<?php echo htmlspecialchars($transaction); ?>">
            <input type="hidden" name="cart_id" value="<?php echo htmlspecialchars($cart_id); ?>">
            <input type="hidden" name="location" value="<?php echo htmlspecialchars($location); ?>">
            <input type="hidden" name="contactNumber" value="<?php echo htmlspecialchars($contactNumber); ?>">
            <button type="submit">Confirm Order</button>
        </form>
    </div>
</div>

</body>
</html>
