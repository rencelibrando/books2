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
$product_id = $_POST['product_id'];
$quantity = intval($_POST['quantity']);
$product_name = $_POST['product_name'];
$product_price = intval($_POST['product_price']);
$payment_method = $_POST['payment_method'];
$transaction = $_POST['transaction'];
$cart_id = $_POST['cart_id'];
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
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .receipt-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            text-align: center;
        }
        .receipt-header {
            font-size: 28px;
            color: #333333;
            margin-bottom: 20px;
        }
        .receipt-details {
            text-align: left;
            font-size: 16px;
            line-height: 1.6;
            color: #666666;
        }
        .receipt-details p {
            margin: 10px 0;
        }
        .receipt-buttons {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
        .receipt-buttons button {
            font-size: 16px;
            background-color: #007BFF;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .receipt-buttons button:hover {
            background-color: #0056b3;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            border-radius: 8px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .modal-input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .modal h2 {
            margin-top: 0;
        }
        .receipt-details-img {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .receipt-details-img img {
            width: 150px;
            height: 150px;
        }
    </style>
</head>
<body>

<div class="receipt-container">
    <div class="receipt-header">Receipt</div>
    <div class="receipt-details">
        <p><strong>Customer Name:</strong> <?php echo $full_name; ?></p>
        <p><strong>Product Name:</strong> <?php echo $product_name; ?></p>
        <p><strong>Quantity:</strong> <?php echo $quantity; ?></p>
        <p><strong>Price per Item:</strong> <?php echo $product_price; ?></p>
        <p><strong>Total Price:</strong> <?php echo $total_price; ?></p>
        <p><strong>Payment Method:</strong> <?php echo $payment_method; ?></p>
        <p><strong>Date:</strong> <?php echo date("Y-m-d H:i:s"); ?></p>
        <div class="receipt-details-img">
            <img src="qr.png" alt="QR Code">
        </div>
        <p><strong>Scan This QR code to Pay via GCash</strong></p>
        <p style="color: red;">***Please Print This Receipt before you confirm your order***</p>
        <p style="color: red;">***Screenshot Your Proof of Payment***</p>
        <hr>
    </div>
    <div class="receipt-buttons">
        <button onclick="window.print()">Print</button>
        <button id="confirmOrderBtn">Confirm Order</button>
        <?php echo "<button onclick='cancelItem({$product_id})'>Cancel Order</button>"; ?>
    </div>
</div>

<div id="locationModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Set Location and Contact</h2>
        <form id="locationForm" action="print_receipt2.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
            <input type="hidden" name="product_name" value="<?php echo $product_name; ?>">
            <input type="hidden" name="product_price" value="<?php echo $product_price; ?>">
            <input type="hidden" name="payment_method" value="<?php echo $payment_method; ?>">
            <input type="hidden" name="transaction" value="<?php echo $transaction; ?>">
            <input type="hidden" name="cart_id" value="<?php echo $cart_id; ?>">
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" class="modal-input" required>
            <label for="contactNumber">Contact Number:</label>
            <input type="number" id="contactNumber" name="contactNumber" class="modal-input" required>
            <button type="submit" class="modal-input" style="background-color: #007BFF; color: white;">Save</button>
        </form>
    </div>
</div>

<script>
var modal = document.getElementById("locationModal");
var confirmOrderBtn = document.getElementById("confirmOrderBtn");
var closeBtn = document.getElementsByClassName("close")[0];

confirmOrderBtn.onclick = function() {
    modal.style.display = "block";
}

closeBtn.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function cancelItem(productId) {
    // Display confirmation alert
    var confirmDelete = confirm("Are you sure you want to cancel this item?");
    
    // If user confirms the deletion
    if (confirmDelete) {
        // Redirect to delete script passing product id
        window.location.href = "delete_item.php?product_id=" + productId;
    }
}
</script>

</body>
</html>
