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

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>JUNCTION Book Store - Orders</title>
<link rel="shortcut icon" type="image/x-icon" href="https://i.ibb.co/VgPWV0q/judith.png">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://kit.fontawesome.com/38741bd1fa.js" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="header.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body, h1, h2, h3, h4, h5, h6 {
    font-family: "Lato", sans-serif;
}
.w3-bar, h1, button {
    font-family: "Montserrat", sans-serif;
}
.w3-bar .w3-button {
    background-color: black;
    color: white;
}
.w3-button.active {
    background-color: #2E2E2E;
    color: white;
}
header, .orders-container, footer {
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
    background-color: #f9f9f9;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}
header {
    text-align: center;
}
header h1 {
    font-weight: 900;
    font-family: 'Times New Roman', Times, serif;
    border: 2px solid #fff;
    border-style: inset;
    border-width: 4px;
    border-radius: 15px;
}
header p {
    font-weight: bold;
    font-style: normal;
    font-family: 'Times New Roman', Times, serif;
}
.orders-container {
    padding: 20px;
}
.order-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}
.order-item img {
    max-width: 100px;
    border-radius: 10px;
}
.order-item-details {
    flex: 1;
    margin-left: 20px;
}
.order-item h6 {
    margin: 0;
    font-size: 18px;
}
.order-item p {
    margin: 5px 0;
    color: #555;
}
.order-item .total-price {
    font-size: 20px;
    font-weight: bold;
    color: #333;
}
button, select {
    padding: 10px 15px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
button {
    background-color: #28a745;
    color: white;
}
button.delete {
    background-color: #dc3545;
}
button:hover {
    opacity: 0.9;
}
button:active {
    transform: scale(0.98);
}
footer {
    text-align: center;
    padding: 30px 0;
    background-color: #2E2E2E;
    color: white;
}
footer .logo {
    width: 50px;
    opacity: inherit;
}
</style>
</head>
<body>

<!-- Navbar -->
<div class="w3-top">
    <div class="w3-bar w3-black w3-left-align w3-large w3-padding-small">
        <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
        <button onclick="window.location.href = 'products.php';" class="w3-button w3-padding-large">Products</button>
        <button onclick="window.location.href = 'cart.php';" class="w3-button w3-padding-large">Cart</button>
        <button id="ordersButton" class="w3-button w3-padding-large active">Orders</button>
        <a href="logout.php" class="w3-bar-item w3-button w3-padding-large w3-large w3-right">Logout</a>
    </div>
</div>
<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="cart.php" class="w3-bar-item w3-button w3-padding-large">Cart</a>
    <a href="products.php" class="w3-bar-item w3-button w3-padding-large">Products</a>
    <a href="orders.php" class="w3-bar-item w3-button w3-padding-large">Orders</a>
    <a href="logout.php" class="w3-bar-item w3-button w3-padding-large w3-large w3-right">Logout</a>
</div>

<!-- Header -->
<header class="w3-container w3-center w3-padding-64">
    <h1 class="w3-margin w3-jumbo">JUNCTION ONLINE BOOK STORE</h1>
    <p class="w3-xlarge">Your Orders</p>
</header>

<!-- Orders Container -->
<div class="orders-container">
    <h2>Order Details</h2>
    <?php
    // Fetch data from orders table for the logged-in user
    $sql = "SELECT o.order_id, o.product_id, o.quantity, o.status, s.name, s.price, s.stock, st.status AS order_status
            FROM orders o 
            INNER JOIN stock s ON o.product_id = s.product_id 
            INNER JOIN status st ON o.status = st.id
            WHERE o.user_id = $user";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Fetch product details
            $product_id = $row["product_id"];
            $quantity = $row["quantity"];
            $product_name = $row["name"];
            $product_image = $row["product_id"];
            $product_price = $row["price"];
            $product_stock = $row["stock"];
            $product_status = $row["order_status"];

            $prc = $product_price * $quantity;
            $update_stock = $product_stock - $quantity;

            echo "<div class='order-item'>";
            echo "<img src='" . htmlspecialchars($product_image) . ".png' alt='$product_name'>";
            echo "<div class='order-item-details'>";
            echo "<h6>$product_name</h6>";
            echo "<p>Quantity: $quantity</p>";
            echo "<p class='total-price'>Total Price: $prc</p>";
            echo "<p>Updated Stock: $update_stock</p>";
            echo "<p>Status: $product_status</p>";
            echo "</div>";

            echo "<button class='delete' onclick='cancelItem({$product_id})'>Cancel Order</button>";
            echo "</div>";
            echo "<hr style='border-top: 1px solid #000;'>";
        }
    } else {
        echo "<p>No items in your orders</p>";
    }
    ?>
</div>

<!-- Footer -->
<footer class="w3-container">
    <div class="w3-xlarge w3-padding-5 w3-margin-top w3-border-black">
        <img src="https://i.ibb.co/VgPWV0q/judith.png" alt="Junction book store" class="logo">
    </div>
    <p>Group 11<a></a></p>
</footer>

<script>
// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
// Function to handle cancel button click
function cancelItem(productId) {
    // Display confirmation alert
    var confirmDelete = confirm("Are you sure you want to cancel this order?");
    
    // If user confirms the cancellation
    if (confirmDelete) {
        // Redirect to cancel script passing product id
        window.location.href = "delete_item.php?product_id=" + productId;
    }
}
</script>

</body>
</html>
