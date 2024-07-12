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
<title>KNOWLEDGE JUNCTION - Cart</title>
<link rel="shortcut icon" type="x-icon" href="https://i.ibb.co/VgPWV0q/judith.png">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="header.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-uefG6BFkAbIR+O88OflNRaHpGshb5+HTmRD6l+zmLZAdS8+4M6EUZ2dE/cQlmFUYwHg3cRQ5RLOVYOliMfXlkA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/w3-css/4.1.0/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
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
.cart-container {
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
    background-color: #f9f9f9;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}
.cart-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}
.cart-item img {
    max-width: 100px;
    border-radius: 10px;
}
.cart-item-details {
    flex: 1;
    margin-left: 20px;
}
.cart-item h6 {
    margin: 0;
    font-size: 18px;
}
.cart-item p {
    margin: 5px 0;
    color: #555;
}
.cart-item .total-price {
    font-size: 20px;
    font-weight: bold;
    color: #333;
}
.cart-item .actions {
    display: flex;
    align-items: center;
    gap: 10px;
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
        <button id="cartsButton" class="w3-button w3-padding-large active">Cart</button>
        <button onclick="window.location.href = 'orders.php';" class="w3-button w3-padding-large">Orders</button>
        <a href="logout.php" class="w3-bar-item w3-button w3-padding-large w3-large w3=margin-top w3-right">Logout</a>
    </div>
</div>
<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="cart.php" class="w3-bar-item w3-button w3-padding-large;">Cart</a>
    <a href="products.php" class="w3-bar-item w3-button w3-padding-large">Product</a>
    <a href="orders.php" class="w3-bar-item w3-button w3-padding-large">Orders</a>
    <a href="logout.php" class="w3-bar-item w3-button w3-padding-large w3-large w3=margin-top w3-right">Logout</a>
</div>

<!-- Header -->
<header class="w3-container w3-center w3-padding-64">
    <h1 class="w3-margin w3-jumbo" style="font-weight: 900; font-family:'Times New Roman', Times, serif; border: 2px solid rgb(255, 255, 255); border-style: inset; border-width: 4px; border-radius: 15px;">JUNCTION ONLINE BOOK STORE</h1>
    <p class="w3-xlarge" style="font-weight: bold; font-style: normal; font-family: 'Times New Roman', Times, serif;">Your Cart</p>
</header>

<!-- Cart Container -->
<div class="cart-container">
    <h2>Cart Details</h2>
    <?php
    // Fetch data from carts table for the logged-in user
    $sql = "SELECT c.product_id,c.cart_id, c.quantity, s.name, s.price, s.stock 
            FROM carts c 
            INNER JOIN stock s ON c.product_id = s.product_id 
            WHERE c.user_id = $user AND active = 0";
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
            $cart_id = $row["cart_id"];
            $prc=$product_price*$quantity;

            echo "<div class='cart-item'>";
            echo "<img src='" . htmlspecialchars($product_image) . ".png' alt='$product_name'>";
            echo "<div class='cart-item-details'>";
            echo "<h6>$product_name</h6>";
            echo "<p>Stock: $product_stock</p>";
            echo "<p class='total-price'>TOTAL PRICE: $prc</p>";
            echo "<p>Quantity in Cart: $quantity</p>";
            echo "</div>";

            echo "<div class='actions'>";
            ?>
            <form action="print_receipt.php" method="POST">
                <!-- Hidden fields to pass product data -->
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
                <input type="hidden" name="product_name" value="<?php echo $product_name; ?>">
                <input type="hidden" name="product_price" value="<?php echo $product_price; ?>">
                <input type="hidden" name="cart_id" value="<?php echo $cart_id; ?>">
                <!-- Mode of transaction dropdown -->
                <label for="transaction">Shipping Method:</label>
                <select name="transaction" id="transaction">
                    <option value="Lalamove">Lalamove</option>
                    <option value="J&T">J&T</option>
                    <option value="Flash">Flash Express</option>
                    <option value="Ninja">Ninja Van</option>
                </select><br>
                <!-- Payment method selection -->
                <label for="payment_method">Select Payment Method:</label>
                <select name="payment_method" id="payment_method" required>
                    <option value="GCash">GCash</option>
                </select><br>
                <button type="submit">Buy Now</button>
            </form>
            <?php
            echo "<button class='delete' onclick='cancelItem({$product_id})'>Delete item</button>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No items in your cart</p>";
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
    var confirmDelete = confirm("Are you sure you want to delete this item?");
    
    // If user confirms the deletion
    if (confirmDelete) {
        // Redirect to delete script passing product id
        window.location.href = "delete_item.php?product_id=" + productId;
    }
}
</script>

</body>
</html>
