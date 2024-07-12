<?php
session_start();
include 'connect.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verify reCAPTCHA
    if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
        // Your secret key
        $secret = '6LcQbAkqAAAAAAkfOdHVj8ntYo2EvHoeHN9HyaDb';
        // Verify the reCAPTCHA response
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        if ($responseData->success) {
            // Escape user inputs for security
            $first_name = $conn->real_escape_string($_POST['first_name']);
            $last_name = $conn->real_escape_string($_POST['last_name']);
            $contact_number = $conn->real_escape_string($_POST['contact_number']);
            $address = $conn->real_escape_string($_POST['address']);
            $email = $conn->real_escape_string($_POST['email']);
            $password = $conn->real_escape_string($_POST['password']);
            $confirm_password = $conn->real_escape_string($_POST['confirm_password']);

            // Check if any of the details already exist in the database
            $check_details_query = "SELECT * FROM users WHERE first_name=? OR last_name=? OR contact_number=? OR address=? OR email=?";
            $stmt = $conn->prepare($check_details_query);
            $stmt->bind_param("sssss", $first_name, $last_name, $contact_number, $address, $email);
            $stmt->execute();
            $check_details_result = $stmt->get_result();
            if ($check_details_result->num_rows > 0) {
                // Details already exist, display error message
                echo "Some of the details already exist. Please use different details. Redirecting to the registration page...";
                // Redirect to registration page after 2 seconds
                header("refresh:2;url=registration.php");
                exit();
            } else {
                // Check if passwords match
                if ($password !== $confirm_password) {
                    die("Passwords do not match.");
                }

                // Hash the password for security
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Query to insert user data into the database
                $sql = "INSERT INTO users (first_name, last_name, contact_number, address, email, password) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssss", $first_name, $last_name, $contact_number, $address, $email, $hashed_password);

                if ($stmt->execute()) {
                    echo "Registration successful. Redirecting to login page...";
                    header("refresh:2;url=login.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            $stmt->close();
        } else {
            echo 'Robot verification failed, please try again.';
        }
    } else {
        echo 'Please click on the reCAPTCHA box.';
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="x-icon" href="https://i.ibb.co/VgPWV0q/judith.png">
    <title>KNOWLEDGE JUNCTION Book Store - Registration</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://kit.fontawesome.com/38741bd1fa.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="registration.css"> 
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
      body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
      .w3-bar,h1,button {font-family: "Montserrat", sans-serif}
    </style>
</head>

<body>   
    <div class="w3-bar">
        <div class="w3-bar w3-card w3-black w3-left-align w3-large w3-padding-small">
          <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
          <a href="index.php" class="w3-bar-item w3-button w3-padding-large ">Home</a>
          <a href="login.php" class="w3-bar-item w3-button w3-padding-large w3-large w3=margin-top w3-right ">Login</a>
          <a href="index.php" class="w3-button w3-padding-large w3-large w3-right">Register</a>
        </div>
    </div>

    <!--signup form-->
    <div class="container">
        <div class="registration-form">
            <h1 class="title">Register</h1>
            <form method="post" action="registration.php" onsubmit="return validateForm()">
                <div class="input-group">
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="first_name" placeholder="First Name" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="last_name" placeholder="Last Name" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-phone"></i>
                        <input type="tel" name="contact_number" placeholder="Contact #" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-home"></i>
                        <input type="text" name="address" placeholder="Address" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    </div>
                </div>
                <div class="g-recaptcha" data-sitekey="6LcQbAkqAAAAAL_Z7h113eUeEs-GDQc-hx2fusDA"></div>
                <button type="submit" class="signup">Register</button>
                <button class="login w3-right" type="button" onclick="location.href='login2.php';">Log in</button>
            </form>
        </div>
    </div>
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
