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

// Fetch data from stock table
$sql_stock = "SELECT * FROM stock";
$result_stock = $conn->query($sql_stock);

// Initialize stock data array
$stock_data = [];
if ($result_stock->num_rows > 0) {
    while($row = $result_stock->fetch_assoc()) {
        $stock_data[] = $row;
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Printable Stock Data</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
.container {
    margin-top: 20px;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
table, th, td {
    border: 1px solid black;
    padding: 8px;
    text-align: center;
}
th {
    background-color: #f2f2f2;
}
</style>
</head>
<body>

<div class="container">
    <h1><?php echo $welcome_message; ?></h1>
    
    <h2>Stock Data</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Stock</th>
                <th>Price</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stock_data as $row): ?>
                <tr>
                    <td><?php echo $row['ID']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['stock']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Return button -->
    <button class="btn btn-primary" onclick="goBack()">Go Back</button>
</div>

<script>
// JavaScript function to navigate back to admin.php
function goBack() {
    window.location.href = 'admin.php';
}
</script>

</body>
</html>
