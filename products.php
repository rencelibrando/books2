<?php
// Start session
session_start();
include 'connect.php';
// Check if the user is logged in
if(isset($_SESSION['user_id'])) {
    // User is logged in, get user's name from session and capitalize it
    $first_name = ucfirst(strtolower($_SESSION['first_name']));
    $last_name = ucfirst(strtolower($_SESSION['last_name']));
    // Generate welcome message
    $welcome_message = "Welcome, $first_name $last_name!";
} else {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit; // Ensure script stops execution after redirect
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
body, h1, h2, h3, h4, h5, h6 {
    font-family: "Lato", sans-serif;
}
.w3-bar, h1, button {
    font-family: "Montserrat", sans-serif;
}
.fa-anchor, .fa-coffee {
    font-size: 300px;
}
.w3-bar .w3-button {
    background-color: black;
    color: white;
}
.w3-button.active {
    background-color: #2E2E2E;
    color: white;
}
.view1 {
    background-color:darkgray;
    border-color: black;
  border-width: 5px;
  border-style: solid;
  width: 350px;
  height: 500px;
  position: relative; /* Change absolute to relative */
  left: 50%;
  transform: translateX(-50%);
  margin-bottom: 10px; /* Adjust this value as needed */
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
        <button id="productsButton" class="w3-button w3-padding-large active">Products</button>
        <button onclick="window.location.href = 'cart.php';" class="w3-button w3-padding-large">Cart</button>
        <button onclick="window.location.href = 'orders.php';" class="w3-button w3-padding-large">Orders</button>
        <a href="logout.php" class="w3-bar-item w3-button w3-padding-large w3-large w3=margin-top w3-right">Logout</a>
        <!-- <a href="registration.php" class="w3-button w3-padding-large w3-large w3-right">Register</a> -->
    </div>
</div>
<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="cart.php" class="w3-bar-item w3-button w3-padding-large">Cart</a>
    <a href="products.php" class="w3-bar-item w3-button w3-padding-large active">Products</a>
    <a href="orders.php" class="w3-bar-item w3-button w3-padding-large">Orders</a>
    <button href="logout.php" class="w3-bar-item w3-button w3-padding-large w3-large w3=margin-top">Logout</button>
    <!-- <a href="registration.php"class="w3-button w3-red w3-padding-large w3-large w3-right">Register</a> -->
</div>

<!-- Header -->
<header class="w3-container w3-center">
    <h1 class="w3-margin w3-text-white w3-jumbo" style="font-weight: 900; font-family:'Times New Roman', Times, serif; border: 2px solid rgb(255, 255, 255); border-style: inset;border-width: 4px;border-radius: 15px;">JUNCTION ONLINE BOOK STORE</h1>
    <p class="w3-xlarge w3-text-white" style="font-weight: bold; font-style: normal; font-family: 'Times New Roman', Times, serif;"><?php echo $welcome_message; ?></p>
</header>

<!-- Your Cart Content Here -->
<footer class="w3-container w3-grey w3-padding-50 w3-center">
<div>
    <div class="w3-xlarge w3-padding-5 w3-margin-top w3-border-black">
        <img src="https://i.ibb.co/VgPWV0q/judith.png" alt="earist book store" class="logo" style="width: 50px; opacity:inherit;">
    </div>
    <div class="w3-light-grey w3-padding-64 w3-container">
        <div class="title">
            <h1>GET YOURS NOW!</h1>
        </div>
        <div class="image-container">
            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>  
                <a href="v1.php" class="button">
                    <img src="1.png" alt="college algebra" class="fil-size">
                    <h6>MASTERING COLLEGE ALGEBRA</h6><h6>₱ 280.00</h6>
                </a>
                </div>
            </div>

            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>
                <a href="v2.php" class="button">
                    <img src="2.png" alt="college freshman english" class="fil-size">
                    <h6>COLLEGE FRESHMAN ENGLISH</h6><h6>₱ 350.00</h6>
                </a>
                </div>
            </div>

            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>  
                <a href="v3.php" class="button">
                    <img src="3.png" alt="SURVEYING LAB MANUAL" class="fil-size">
                    <h6>SURVEYING LAB MANUAL</h6><h6>₱ 280.00</h6>
                </a>
                </div>
            </div>

            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>  
                <a href="v4.php" class="button">
                    <img src="4.png" alt="MECHANICAL ENGINEERING FORMULAS" class="fil-size">
                    <h6>MECHANICAL ENGINEERING FORMULAS</h6><h6>₱ 280.00</h6>
                </a>
                </div>
            </div>

            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>  
                <a href="v5.php" class="button">
                    <img src="5.png" alt="VIDEO PRODUCTION AND DIGITAL PHOTOGRAHPHY FOR BEGINNERS" class="fil-size">
                    <h6>VIDEO PRODUCTION AND DIGITAL PHOTOGRAHPHY FOR BEGINNERS</h6><h6>₱ 425.00</h6>
                </a>
                </div>
            </div>

            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>  
                <a href="v6.php" class="button">
                    <img src="6.png" alt="BASIC FUNDAMENTALS OF STRUCTURAL STEEL DESIGN" class="fil-size">
                    <h6>BASIC FUNDAMENTALS OF STRUCTURAL STEEL DESIGN</h6><h6>₱ 420.00</h6>
                </a>
                </div>
            </div>

            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>  
                <a href="v7.php" class="button">
                    <img src="7.png" alt="POWER PLANT ENGINEERING" class="fil-size">
                    <h6>POWER PLANT ENGINEERING</h6><h6>₱ 420.00</h6>
                </a>
                </div>
            </div>

            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>  
                <a href="v8.php" class="button">
                    <img src="8.png" alt="DIFFERENTIAL AND INTEGRAL CALCULUS" class="fil-size">
                    <h6>DIFFERENTIAL AND INTEGRAL CALCULUS</h6><h6>₱ 420.00</h6>
                </a>
                </div>
            </div>

            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>  
                <a href="v9.php" class="button">
                    <img src="9.png" alt="RESPONSIVE WEB DESIGN" class="fil-size">
                    <h6>RESPONSIVE WEB DESIGN</h6><h6>₱ 425.00</h6>
                </a>
                </div>
            </div>

            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>  
                <a href="v10.php" class="button">
                    <img src="10.png" alt="RESPONSIVE WEB DESIGN" class="fil-size">
                    <h6>COMPUTER BASIC NETWORKING</h6><h6>₱ 425.00</h6>
                </a>
                </div>
            </div>

            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>  
                <a href="v11.php" class="button">
                    <img src="11.png" alt="RESPONSIVE WEB DESIGN" class="fil-size">
                    <h6>RESPONSIVE WEB DESIGN</h6><h6>₱ 425.00</h6>
                </a>
                </div>
            </div>

            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>  
                <a href="v12.php" class="button">
                    <img src="12.png" alt="WEB DESIGN" class="fil-size">
                    <h6>WEB DESIGN</h6><h6>₱ 425.00</h6>
                </a>
                </div>
            </div>

            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>  
                <a href="v13.php" class="button">
                    <img src="13.png" alt="RESPONSIVE WEB DESIGN" class="fil-size">
                    <h6>E-TECH</h6><h6>₱ 425.00</h6>
                </a>
                </div>
            </div>

            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>  
                <a href="v14.php" class="button">
                    <img src="14.png" alt="JAVA PROGRAMMMING BY EXAMPLE" class="fil-size">
                    <h6>JAVA PROGRAMMMING BY EXAMPLE</h6><h6>₱ 425.00</h6>
                </a>
                </div>
            </div>

            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>  
                <a href="v15.php" class="button">
                    <img src="15.png" alt="PROJECT MANAGEMENT AND VIDEO PRODUCTION" class="fil-size">
                    <h6>PROJECT MANAGEMENT AND VIDEO PRODUCTION</h6><h6>₱ 425.00</h6>
                </a>
                </div>
            </div>

            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>  
                <a href="v16.php" class="button">
                    <img src="16.png" alt="COMPUTER SYSTEM SERVICING" class="fil-size">
                    <h6>COMPUTER SYSTEM SERVICING</h6><h6>₱ 425.00</h6>
                </a>
                </div>
            </div>

            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>  
                <a href="v17.php" class="button">
                    <img src="17.png" alt="OFFICE  PRODUCTIVITY" class="fil-size">
                    <h6>OFFICE  PRODUCTIVITY</h6><h6>₱ 425.00</h6>
                </a>
                </div>
            </div>

            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>  
                <a href="v18.php" class="button">
                    <img src="18.png" alt="PROGRAMMING FUNDAMENTALS" class="fil-size">
                    <h6>PROGRAMMING FUNDAMENTALS</h6><h6>₱ 425.00</h6>
                </a>
                </div>
            </div>

            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>  
                <a href="v19.php" class="button">
                    <img src="19.png" alt="ANATOMY AND PHYSIOLOGY" class="fil-size">
                    <h6>ANATOMY AND PHYSIOLOGY</h6><h6>₱ 2000.00</h6>
                </a>
                </div>
            </div>

            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>  
                <a href="v20.php" class="button">
                    <img src="20.png" alt="NURING THEORIST" class="fil-size">
                    <h6>NURING THEORIST</h6><h6>₱ 700.00</h6>
                </a>
                </div>
            </div>

            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>  
                <a href="v21.php" class="button">
                    <img src="21.png" alt="ELEMENTS OF ROADS AND HIGHWAYS" class="fil-size">
                    <h6>ELEMENTS OF ROADS AND HIGHWAYS</h6><h6>₱ 180.00</h6>
                </a>
                </div>
            </div>

            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>  
                <a href="v22.php" class="button">
                    <img src="22.png" alt="CIVIL ENGINEERING" class="fil-size">
                    <h6>CIVIL ENGINEERING</h6><h6>₱ 300.00</h6>
                </a>
                </div>
            </div>

            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>  
                <a href="v23.php" class="button">
                    <img src="23.png" alt="COMMUNICATION ENGINEERING" class="fil-size">
                    <h6>COMMUNICATION ENGINEERING</h6><h6>₱ 300.00</h6>
                </a>
                </div>
            </div>

            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>  
                <a href="v24.php" class="button">
                    <img src="24.png" alt="SOLID STATE PULSE CIRCUITS" class="fil-size">
                    <h6>SOLID STATE PULSE CIRCUITS</h6><h6>₱ 250.00</h6>
                </a>
                </div>
            </div>

            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>  
                <a href="v25.php" class="button">
                    <img src="25.png" alt="FINANCIAL ACCOUNTING THEORY" class="fil-size">
                    <h6>FINANCIAL ACCOUNTING THEORY</h6><h6>₱ 350.00</h6>
                </a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer -->
<footer class="w3-container w3-grey w3-padding-20 w3-center">  
    <div class="w3-container w3-black w3-center w3-padding-10">
        <h5 class="w3-margin" style="font-style: italic; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;font-weight: 600;">Life is like a book that never ends. Chapters close, but not the book itself</h5>
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
</script>

</body>
</html>
