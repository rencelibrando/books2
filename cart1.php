<?php
// Start session
session_start();

include 'connect.php';
// Check if the user is logged in
if(isset($_SESSION['user_id'])) {
    // User is logged in, get user's name from session and capitalize it
    $first_name = ucfirst(strtolower($_SESSION['first_name']));
    $last_name = ucfirst(strtolower($_SESSION['last_name']));
    $qnty = ucfirst(strtolower($_POST['qnty']));
    $prc= $_POST['prc'];
    $prid= $_POST['prid'];
    // Generate welcome message
    $welcome_message = "Welcome, $first_name $last_name!";
} else {
    // User is not logged in, set default welcome message
    $welcome_message = "Welcome!";
}

$sql = "SELECT * FROM stock";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$price=$qnty*$prc;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Judith Book Store - Products</title>
<link rel="shortcut icon" type="x-icon" href="https://i.ibb.co/VgPWV0q/judith.png">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://kit.fontawesome.com/38741bd1fa.js" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="header.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <div class="view1 " style="text-align: center;">
    <br>  
    <?php

    $user = $_SESSION['user_id'];
    $date = date("Y-m-d H:i:s");

    // Query to insert user data into the database
    $sql = "INSERT INTO carts (user_id, product_id, quantity, created_at) VALUES ('$user', '$prid', '$qnty', '$date')";

    if ($conn->query($sql) === TRUE) {
        // Cart item added successfully
        echo "Added to Cart! Redirecting to PRODUCTS page...";
        // Redirect to products page after 2 seconds
        header("refresh:2;url=products.php");
        exit();
    } else {
        // Error adding item to cart
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    ?>
</footer>
</body>
</html>
