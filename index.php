<?php
session_start();
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>KNOWLEDGE JUNCTION ONLINE BOOKSTORE</title>
<?php include 'header.html'; ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://kit.fontawesome.com/38741bd1fa.js" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="header.css">
<script src="https://kit.fontawesome.com/38741bd1fa.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:300px}

/* Adjust modal styles */
.w3-modal-content {
  max-width: 600px;
}

/* Hide avatar logo */
.avatar-logo {
  display: none;
}
.passwidth{
  width:300px;
}
.container{
  background-image: url(regisback.png);
  background-size: cover;
  background-position: center;
  background-attachment: scroll;
  background-repeat: no-repeat;
  display: flex;
  align-items: center;
  justify-content: center;
  justify-self: center;
  height: 130vh; 
  opacity: 1;
  position: relative;
}

.registration-form {
  position: absolute;
  background-color: #f8f8f8; 
  padding: 30px;
  border-radius: 15px; 
  border-style: inset;
  border-width: 6px;
  box-shadow: 0px 20px 20px rgba(12, 11, 11, 0.2); /* Fixed missing opacity value */
  border-color: rgb(0, 0, 0);
  font-size: 15px;
  opacity: 80%;
  color: rgb(228, 214, 214);
  margin-top: 300px; /* Adjusted to move the div further up */
}


.input-field{
  align-self: center;
  color: #000;
  padding: 10px;
  font-size: medium;
}
.input-group{
  padding: 2px;
  color: #000;
  position: relative;
  border-radius: 7px;
  font-size: 10px;
  text-align: left;
  font-family: 'Times New Roman', Times, serif;
}
.title{
  font-weight:900;
  color: #000;
  font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
  font-size: 40px;
  font-style: italic;
  position: relative;
  margin-top: 5px;
  text-align: center;
}
.logo{
    width: 50px;
    opacity:inherit;
}
.w3-margin{
  font-style: italic;
  font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
  font-weight: 600;
  justify-content: space-between;
  margin: 5px;
}
.signup{
  font-size: 22px;
  background-color: #080808;
  color: #ffffff;
  font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
  font-style: italic;
  font-weight: bolder;
}
.login{
  font-size: 22px;
  background-color: #000000;
  color: #ffffff;
  font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
  font-style: italic;
  font-weight: bolder;
  place-items: end;
}
.buttons{
  padding-top: 25px;
  padding-left: 25px;
  padding-right: 13px;
}
.signup:hover{
  background: #ff0000;
  color: #ffffff;
}
.login:hover{
  background: #ff0000;
  color: #ffffff;
}
.signin{
  font-size: 22px;
  background-color: #BC0000;
  color: #ffffff;
  font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
  font-style: italic;
  font-weight: bolder;
}
.background{
  background-size: cover;
  background-position: center;
  background-attachment: scroll;
  background-repeat: no-repeat;
  display: flex;
  align-items: center;
  justify-content: center;
  justify-self: center;
  height: 10vh; 
  opacity: 1;
  position: relative;
  background-color:  rgb(236, 221, 221);
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
    <button onclick="window.location.href = 'index.php';" class="w3-button w3-padding-large">Home</button>
    <!-- <button onclick="window.location.href = 'cart.php';" class="w3-button w3-padding-large">Cart</button>
    <button onclick="window.location.href = 'products.php';" class="w3-button w3-padding-large">Products</button>
    <button onclick="window.location.href = 'orders.php';" class="w3-button w3-padding-large">Orders</button> -->
    <button onclick="document.getElementById('loginModal').style.display='block'" class="w3-bar-item w3-button w3-padding-large w3-large w3=margin-top w3-right">Login</button>
    <a href="registration.php" class="w3-button w3-padding-large w3-large w3-right">Register</a>
  </div>
</div>

<!-- Header -->
<header class="w3-container w3-center">
  <h1 class="w3-margin w3-text-white w3-jumbo" style="font-weight: 900; font-family:'Times New Roman', Times, serif; border: 2px solid rgb(000000); border-style: inset;border-width: 4px;border-radius: 15px; opacity: 100%">KNOWLEDGE JUNCTION ONLINE BOOKSTORE</h1>
  <p class="w3-xlarge w3-text-white" style="font-weight: bold; font-style: normal; font-family: 'Times New Roman', Times, serif;">Shop Now!</p>
</header>

<!-- Login Modal -->
<div class="w3-modal" id="loginModal">
  <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:0px; max-height:0px;">
    <div class="w3-center"><br>
      <!-- <span onclick="document.getElementById('loginModal').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span> -->
    </div>
    <div class="background">
      <div class="container">
        <div class="registration-form">
          <h1 class="title">Sign in to Your Account</h1>
          <div class="fcontainer">
            <form method="post" action="login.php">
              <div class="input-group">
                <div class="input-field">
                  <i class="fa-regular fa-user"></i>
                  <input type="email" name="email" size="35" placeholder="Email:">
                </div>
                <div class="input-field">
                  <i class="fa-regular fa-user"></i><BR>
                  <input type="password" name="password" id="password" class="passwidth" size="35" placeholder="Password:" required>
                  <span toggle="#password" class="fa fa-eye field-icon toggle-password"></span>
                  
                </div>

                <div class="buttons" style="display: flex; justify-content: space-between;">
                  <button class="signin" onclick="document.getElementById('loginModal').style.display='none'" type="button">Cancel</button>
                  <div style="width: 20px;"></div> <!-- Add space here -->
                  <button class="signin" type="submit">Sign In</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-twothird">
      <h1 style="font-weight: bolder;font-family: 'Times New Roman', Times, serif;">About Us</h1>
      <p class="w3-text-grey">Welcome to Knowledge Junction Online Bookstore, proudly benefiting Nanay Malou Lognorio. For the past two years, this family-run business has dedicated itself to the world of bookselling. The Lognorio family's passion for books and the joy of spreading knowledge are at the core of their business. Nanay Malou, along with her supportive spouse and four children, has built this venture from the ground up. Despite their busy academic schedules, her children actively contribute to the business, balancing their studies with the responsibilities of running an online bookstore.</p>
    </div>

    <div class="w3-third w3-center">    
      <img src="https://i.ibb.co/hmvHSZy/download.png" alt="Book" class="icon-bigger" style="width: 400px;">
    </div>
  </div>
</div>

<!--second grid-->

<div class=" w3-light-grey w3-padding-64 w3-container">
  <div class="title">
    <a href="login2.php" class="button">GET YOURS NOW!</a>

</div>
<div class="image-container">
            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>
                    <a href="registration.php">
                    <img src="1.png" alt="college algebra" class="fil-size">
                    <h6>MASTERING COLLEGE ALGEBRA</h6><h6>₱ 280.00</h6>
                    </a>
                </div>  
            </div>

            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>
                    <a href="registration.php">
                    <img src="2.png" alt="college freshman english" class="fil-size">
                    <h6>COLLEGE FRESHMAN ENGLISH</h6><h6>₱ 350.00</h6>
                    </a>                    
                </div>
            </div>

            <div class=" w3-light-grey w3-padding-64 w3-container">
                <div class="view1 " style="text-align: center;">
                <br>  
                    <a href="registration.php">
                    <img src="3.png" alt="Life And Works Of Rizal" class="fil-size">
                    <h6>SURVEYING LAB MANUAL</h6><h6>₱ 280.00</h6>
                    </a>                   
                </div>
            </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="w3-container w3-black w3-center w3-padding-10">
<h5 class="w3-margin " style="font-style: italic; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;font-weight: 600;">Life is like a book that never ends. Chapters close, but not the book itself</h5>
</div>
<!-- Footer -->
<footer class="w3-container w3-grey w3-padding-30 w3-center ">  
<div class="w3-xlarge w3-padding-5 w3-margin-top w3-border-black">
  <?php include 'foot.html'; ?>
</div>
<div>
</div class="logo">
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
<script>
        function validateForm() {
            var password = document.getElementById("password");
            var confirmPassword = document.getElementById("confirm_password");
            var passwordValue = password.value;
            var confirmValue = confirmPassword.value;

            if (passwordValue !== confirmValue) {
                alert("Passwords do not match.");
                setTimeout(function() {
                    window.location.href = 'registration.php';
                }, 5000); // 5000 milliseconds = 5 seconds
                return false;
            }
            return true;
        }
        // Function to toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(function(button) {
            button.addEventListener('click', function() {
                var passwordInput = button.previousElementSibling;
                var fieldType = passwordInput.getAttribute('type');
                if (fieldType === 'password') {
                    passwordInput.setAttribute('type', 'text');
                } else {
                    passwordInput.setAttribute('type', 'password');
                }
            });
        });
    </script>
</body>
</html>
