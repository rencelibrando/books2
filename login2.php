<?php
// Start session
session_start();

// Check if user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: products.php");
    exit();
}

// Database credentials
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
    header("Location: login.php");
    exit();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shorcut icon" type="x-icon" href="https://i.ibb.co/VgPWV0q/judith.png">
    <title>Log In</title>
    <link rel="stylesheet" href="log in.css">
    <script src="https://kit.fontawesome.com/38741bd1fa.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="login2.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
      body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
      .w3-bar,h1,button {font-family: "Montserrat", sans-serif}
      .w3-modal-content {
  max-width: 600px;
}
    </style>
</head>
<body>
    <div class="w3-bar">
        <div class="w3-bar w3-card w3-black w3-left-align w3-large w3-padding-small">
          <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
          <a href="index.php" class="w3-bar-item w3-button w3-padding-large ">Home</a>
          <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-large w3=margin-top w3-right ">Login</a>
          <a href="registration.php" class="w3-button w3-padding-large w3-large w3-right">Register</a>
        </div>
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
                            <i class="fa-regular fa-user"></i>
                            <input type="password" name="password" size="35" placeholder="Password:">
                        </div>
                        <div class="buttons">
                            <button class="signin" type="submit">Sign In</button>
                        </div>
                        <div class="buttons">
                        <button class="signin" onclick="document.getElementById('loginModal').style.display='none'" type="button">Cancel</button>
                        </div>

                </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
    
    <!-- JavaScript Alert -->
    <script>
        // Check if there's an error message, then display it as an alert
        window.onload = function() {
            var errorMessage = "<?php echo isset($_SESSION['error']) ? $_SESSION['error'] : ''; ?>";
            if(errorMessage !== '') {
                alert(errorMessage);
                <?php unset($_SESSION['error']); // Clear the error message ?>
            }
        }
    </script>

    <!--quotes -->
    <div class="w3-container w3-black w3-center w3-padding-10">
        <h5 class="w3-margin ">Life is like a book that never ends. Chapters close, but not the book itself</h5>
    </div>
    
    <!--footer-->
    <footer class="w3-container w3-grey w3-padding-10 w3-center">  
        <div class="w3-xlarge w3-padding-5 w3-margin-top w3-border-black" >
            <img src="https://i.ibb.co/VgPWV0q/judith.png" alt="earist book store" class="logo";>
        </div>
        <div>
        </div class="logo">
        
        <p>Group 11<a></a></p>
    </footer>
</body>
</html>
