<?php
// Start session
session_start();

// Check if user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: products.php");
    exit();
}

include 'connect.php';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // Check for admin credentials first
    if ($email === "admin@admin" && $password === "admin123") {
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = 0; // Admin ID, can be anything or set another way
        $_SESSION['first_name'] = "Admin";
        $_SESSION['last_name'] = "";
        $_SESSION['email'] = $email;
        header("Location: admin.php");
        exit();
    }

    // Query to check if user exists with the provided credentials
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, set session variables and redirect to dashboard or desired page
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $row['user_id']; // Store user's ID
            $_SESSION['first_name'] = $row['first_name']; // Store user's first name
            $_SESSION['last_name'] = $row['last_name']; // Store user's last name
            $_SESSION['email'] = $email;
            header("Location: products.php");
            exit();
        } else {
            // Password is incorrect, display error message
            $_SESSION['error'] = "Invalid email or password. Please try again.";
        }
    } else {
        // User not found, display error message
        $_SESSION['error'] = "Invalid email or password. Please try again.";
    }
    header("Location: login3.php");
    exit();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Judith Book Store</title>
<link rel="shortcut icon" type="image/x-icon" href="https://i.ibb.co/VgPWV0q/judith.png">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="header.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
/* Global Styles */
body, h1, h2, h3, h4, h5, h6 {
  font-family: "Lato", sans-serif;
  margin: 0;
}

.w3-bar, h1, button {
  font-family: "Montserrat", sans-serif;
}

/* Navbar Styles */
.w3-top {
  position: sticky;
  top: 0;
  z-index: 1000;
}

.w3-bar {
  background-color: #000;
  color: #fff;
}

.w3-bar a, .w3-bar button {
  padding: 12px 20px;
  text-decoration: none;
  color: inherit;
  display: inline-block;
  transition: background-color 0.3s;
}

.w3-bar a:hover, .w3-bar button:hover {
  background-color: #555;
}

/* Header Styles */
header {
  background-color: #000;
  color: #fff;
  padding: 80px 0;
  text-align: center;
  border: 2px solid #fff;
  border-radius: 15px;
}

header h1 {
  font-weight: 900;
  font-size: 4em;
  padding: 10px 20px;
  border-radius: 15px;
  display: inline-block;
}

header p {
  font-size: 1.5em;
}

/* Modal Styles */
.w3-modal-content {
  max-width: 600px;
  background-color: #f8f8f8;
  padding: 30px;
  border-radius: 15px;
  box-shadow: 0px 20px 20px rgba(0, 0, 0, 0.2);
  color: #000;
}

/* Form Styles */
.registration-form {
  background-color: #f8f8f8;
  padding: 30px;
  border-radius: 15px;
  box-shadow: 0px 20px 20px rgba(0, 0, 0, 0.2);
}

.input-field {
  position: relative;
  margin-bottom: 20px;
}

.input-field input {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.input-field i {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  left: 15px;
  color: #888;
}

.toggle-password {
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
  cursor: pointer;
  color: #888;
}

.buttons {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 20px;
}

.signin {
  background-color: #BC0000;
  color: #fff;
  padding: 12px 24px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.signin:hover {
  background-color: #FF0000;
}

/* Responsive Design */
@media (max-width: 768px) {
  header h1 {
    font-size: 3em;
  }
}
</style>
</head>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-black">
    <a href="index.php" class="w3-bar-item w3-button">Home</a>
    <a href="#" class="w3-bar-item w3-button w3-right" onclick="document.getElementById('loginModal').style.display='block'">Login</a>
    <a href="registration.php" class="w3-bar-item w3-button w3-right">Register</a>
  </div>
</div>

<!-- Header -->
<header>
  <h1>JUDITH ONLINE BOOK STORE</h1>
  <p>Shop Now!</p>
</header>

<!-- Login Modal -->
<div class="w3-modal" id="loginModal">
  <div class="w3-modal-content w3-card-4 w3-animate-zoom">
    <div class="w3-center">
      <span onclick="document.getElementById('loginModal').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
    </div>
    <div class="registration-form">
      <h1 class="title">Sign in to Your Account</h1>
      <form method="post" action="login.php">
        <div class="input-field">
          <i class="fa fa-user"></i>
          <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="input-field">
          <i class="fa fa-lock"></i>
          <input type="password" name="password" id="password" class="passwidth" placeholder="Password" required>
          <span class="toggle-password fa fa-eye"></span>
        </div>
        <div class="buttons">
          <button class="signin" type="button" onclick="document.getElementById('loginModal').style.display='none'">Cancel</button>
          <button class="signin" type="submit">Sign In</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Main Content -->
<div class="w3-content w3-padding-64">
  <div class="w3-twothird">
    <h1>About Us</h1>
    <p>Welcome to Judith Online Book Store, your trusted source for textbooks and reading materials. We cater specifically to first-year students, offering a curated selection of textbooks for various courses. Shopping with us is easy and convenient—browse our website, find your required books, and place your order with secure payment options and prompt delivery.</p>
  </div>
  <div class="w3-third w3-center">
    <img src="https://i.ibb.co/hmvHSZy/download.png" alt="Book" style="width: 80%;">
  </div>
</div>

<!-- Call to Action -->
<div class="w3-container w3-center w3-padding-32">
  <a href="login.php" class="signin">GET YOURS NOW!</a>
</div>

<!-- Product Section -->
<div class="w3-row-padding w3-padding-64">
  <div class="w3-third w3-container">
    <div class="w3-card">
      <img src="1.png" alt="Book 1" style="width: 100%;">
      <div class="w3-container">
        <h6>MASTERING COLLEGE ALGEBRA</h6>
        <h6>₱ 280.00</h6>
      </div>
    </div>
  </div>
  <div class="w3-third w3-container">
    <div class="w3-card">
      <img src="2.png" alt="Book 2" style="width: 100%;">
      <div class="w3-container">
        <h6>COLLEGE FRESHMAN ENGLISH</h6>
        <h6>₱ 350.00</h6>
      </div>
    </div>
  </div>
  <div class="w3-third w3-container">
    <div class="w3-card">
      <img src="3.png" alt="Book 3" style="width: 100%;">
      <div class="w3-container">
        <h6>SURVEYING LAB MANUAL</h6>
        <h6>₱ 280.00</h6>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="w3-container w3-black w3-center w3-padding-32">
  <img src="https://i.ibb.co/VgPWV0q/judith.png" alt="Logo" class="logo">
  <p>Life is like a book that never ends. Chapters close, but not the book itself.</p>
</footer>

<!-- Scripts -->
<script>
// Toggle password visibility
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
