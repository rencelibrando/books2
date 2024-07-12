<?php
session_start();
require 'connect.php'; // Assuming 'connect.php' includes database connection details

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Escape user inputs for security
  $email = $conn->real_escape_string($_POST['email']);
  $otp = $conn->real_escape_string($_POST['otp']);

  // Build the verification query with prepared statement
  $sql = "SELECT * FROM users WHERE email = ? AND otp = ? AND otp_expiry > NOW() AND is_verified = 0";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ss', $email, $otp);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $update_sql = "UPDATE users SET is_verified = 1, otp = NULL, otp_expiry = NULL WHERE email = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();

    if ($stmt->affected_rows === 1) {
      $message = "Your email has been verified successfully. Redirecting to login page...";
      header("refresh:2;url=index.php");
      exit();
    } else {
      // Log the error for debugging
      error_log("Error updating record for email: $email");
      $message = "Verification failed. Please try again.";
    }
  } else {
    $message = "Invalid OTP or OTP has expired. Redirecting to registration page...";
    header("refresh:2;url=earistbookstore.wuaze.com/registration.php");
    exit();
  }

  // Close prepared statement
  $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification with OTP</title>
    <link rel="stylesheet" href="header.css">
    <script src="https://kit.fontawesome.com/38741bd1fa.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* Reset and base styles */
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 5px;
        }
        h1 {
            font-family: 'Lato', sans-serif;
            text-align: center;
            color: #333;
        }
        p {
            text-align: center;
            color: #666;
        }
        form {
            margin-top: 20px;
            text-align: center;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            font-size: 16px;
        }
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        .message {
            margin-top: 20px;
            padding: 10px;
            text-align: center;
            background-color: #f2dede;
            color: #a94442;
            border: 1px solid #ebccd1;
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
            <button onclick="document.getElementById('loginModal').style.display='block'" class="w3-bar-item w3-button w3-padding-large w3-large w3=margin-top w3-right">Login</button>
            <a href="registration.php" class="w3-button w3-padding-large w3-large w3-right">Register</a>
        </div>
    </div>
    
    <!-- Header -->
    <div class="container">
        <div class="verification-form">
            <h1>Email Verification</h1>
            <p>Please enter the OTP sent to your email address:</p>
            <form action="verify_otp.php" method="post">
                <div class="input-group">
                    <input type="text" name="otp" placeholder="Enter OTP" required>
                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']); ?>" required>
                </div>
                <div class="buttons">
                    <button type="submit">Verify OTP</button>
                </div>
            </form>
            <?php if (!empty($message)): ?>
                <div class="message"><?php echo $message; ?></div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
