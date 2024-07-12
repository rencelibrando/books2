<?php
// Start session
session_start();

// Database credentials
include 'connect.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  // User is not logged in, redirect to login page
  header("Location: login.php");
  exit; // Ensure script stops execution after redirect
}

// fetch product stock
$sql = "SELECT * FROM stock where id = 9";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
//echo $row['stock'];

// Check if the user is logged in
if(isset($_SESSION['user_id'])) {
    // User is logged in, get user's name from session and capitalize it
    $first_name = ucfirst(strtolower($_SESSION['first_name']));
    $last_name = ucfirst(strtolower($_SESSION['last_name']));
    // Generate welcome message
    $welcome_message = "Welcome, $first_name $last_name!";
} else {
    // User is not logged in, set default welcome message
    $welcome_message = "Welcome!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>JUNCTION Book Store - Products</title>
<link rel="shorcut icon" type="x-icon" href="https://i.ibb.co/VgPWV0q/judith.png">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://kit.fontawesome.com/38741bd1fa.js" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="header.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:300px}
.view1 {
  border-color: #121212;
  border-width: 6px;
  border-style: solid;
  width: 350px;
  height: 600px;
  position: relative; /* Change absolute to relative */
  left: 50%;
  transform: translateX(-50%);
  margin-bottom: 20px; /* Adjust this value as needed */
  text-align: left;
}
#atc{
 left: 50px;
}
.fil-size{
  width: 250px;
  border-color: black;
  border-width: 1px;
  border-style: solid;
  padding: 2px;
  border-radius: 4px;
}
</style>
</head>
<body>

<!-- Navbar -->
<div class="w3-top">
    <div class="w3-bar w3-black w3-left-align w3-large w3-padding-small">
      <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
      <!-- <button onclick="window.location.href = 'index.php';" class="w3-button w3-padding-large">Home</button> -->
      <button onclick="window.location.href = 'products.php';" class="w3-button w3-padding-large">Products</button>
      <button onclick="window.location.href = 'cart.php';" class="w3-button w3-padding-large">Cart</button>
      <button onclick="window.location.href = 'orders.php';" class="w3-button w3-padding-large">Orders</button>
      <a href="logout.php" class="w3-bar-item w3-button w3-padding-large w3-large w3=margin-top w3-right">Logout</a>
      <!-- <a href="registration.php" class="w3-button w3-padding-large w3-large w3-right">Register</a> -->
    </div>
  </div>
  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="cart.php" class="w3-bar-item w3-button w3-padding-large;">Cart</a>
    <a href="products.php" class="w3-bar-item w3-button w3-padding-large">Product</a>
    <a href="orders.php" class="w3-bar-item w3-button w3-padding-large">Orders</a>
    <button href="logout.php" class="w3-bar-item w3-button w3-padding-large w3-large w3=margin-top ">Logout</button>
    <!-- <a href="registration.php"class="w3-button w3-red w3-padding-large w3-large w3-right">Register</a> -->
  </div>
</div>


<!-- Footer -->
<footer class="w3-container w3-grey w3-padding-30 w3-center ">  
  <!-- <div class="w3-xlarge w3-padding-5 w3-margin-top w3-border-black">
    <img src="https://i.ibb.co/5nwknRj/logo-ng-11.png" alt="earist book store" class="logo" style="width: 50px; opacity:inherit;">
 </div> -->
 <div>

 </div class="logo">
 
 <div class=" w3-light-grey w3-padding-64 w3-container">
    
    <div class="view1 " style="text-align: center;">
    <br>
    <form method="post" action="cart1.php">
            <img src="10.png" alt="COMPUTER NETWORKING BASICS" class="fil-size">
            <h6>COMPUTER NETWORKING BASICS</h6><h6><b>Stock:</b> <?php echo $row['stock']; ?></h6><h6>₱ 425.00</h6>
            <input id="atcn" class="form-control" style="width:25%;border-radius:50px;" type="text" name="qnty" value="1" size="2"/>
            <input id="prc" class="form-control"  type="hidden" name="prc" value="330"/>
            <input id="prid" class="form-control"  type="hidden" name="prid" value="9"/>
            <input id="atc" type="submit" value="Add to cart" class="btn btn-primary" style="width:50%;border-radius:360px;" /></div>
            </form>
    </div>
  </div>
  <div class="w3-container w3-black w3-center w3-padding-10">
    <h5 class="w3-margin " style="font-style: italic; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;font-weight: 600;">Life is like a book that never ends. Chapters close, but not the book itself</h5>
  </div>
  
 
 <p>Group 11<a></a></p>
</footer>
</body>
</html>