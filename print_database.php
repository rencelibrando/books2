<?php
// Start session (if needed)
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit; // Ensure script stops execution after redirect
}

// Include database connection
include 'connect.php';

// Fetch data from stock table
$sql = "SELECT * FROM stock";
$result = $conn->query($sql);

// Initialize stock data array
$stock_data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $stock_data[] = $row;
    }
}

// Function to output data as CSV
function outputCSV($data) {
    $output = fopen("php://output", "w");
    foreach ($data as $row) {
        fputcsv($output, $row);
    }
    fclose($output);
}

// Check if export button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['export'])) {
    // Generate CSV file name
    $filename = "stock_data_" . date('Y-m-d') . ".csv";

    // Set HTTP headers for CSV download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    // Output CSV data
    outputCSV($stock_data);
    exit;
}

// Close connection
$conn->close();

// HTML output starts here
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>JUNCTION Book Store - Products</title>
<link rel="shortcut icon" type="image/x-icon" href="https://i.ibb.co/VgPWV0q/judith.png">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://kit.fontawesome.com/38741bd1fa.js" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="header.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
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
.table-center {
    width: 100%;
    border-collapse: collapse;
}
.table-center th, .table-center td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}
.table-center th {
    background-color: #f2f2f2;
}
.product-image {
    max-width: 100px;
    max-height: 100px;
}
</style>
</head>
<body>

<!-- Navbar -->
<div class="w3-top">
    <div class="w3-bar w3-black w3-left-align w3-large w3-padding-small">
        <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
        <button id="productsButton" class="w3-button w3-padding-large active">Products</button>
        <!-- <button onclick="window.location.href = 'cart.php';" class="w3-button w3-padding-large">Cart</button> -->
        <button onclick="window.location.href = 'admin-orders.php';" class="w3-button w3-padding-large">Orders</button>
        <a href="logout.php" class="w3-bar-item w3-button w3-padding-large w3-large w3=margin-top w3-right">Logout</a>
    </div>
</div>
<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="cart.php" class="w3-bar-item w3-button w3-padding-large">Cart</a>
    <a href="products.php" class="w3-bar-item w3-button w3-padding-large active">Products</a>
    <a href="orders.php" class="w3-bar-item w3-button w3-padding-large">Orders</a>
    <a href="add.php" class="w3-button w3-green w3-large">Add New Product</a>
    <button href="logout.php" class="w3-bar-item w3-button w3-padding-large w3-large w3=margin-top">Logout</button>
</div>

<!-- Header -->
<header class="w3-container w3-center">
    <h1 class="w3-margin w3-text-white w3-jumbo" style="font-weight: 900; font-family:'Times New Roman', Times, serif; border: 2px solid rgb(255, 255, 255); border-style: inset;border-width: 4px;border-radius: 15px;"><?php echo $welcome_message; ?></h1>
</header>

<!-- Stock Table -->
<div class="w3-container">
    <h1>Stock</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <button type="submit" name="export" class="w3-button w3-blue">Export Data as CSV</button>
    </form>
    <table id="stockTable" class="table-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stock_data as $row): ?>
                <tr>
                    <td><?php echo $row['ID']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['stock']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><img src="<?php echo $row['product_id']; ?>" alt="Product Image" class="product-image"></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['ID']; ?>" class="w3-button w3-blue w3-small">Edit</a>
                        <a href="delete.php?id=<?php echo $row['ID']; ?>" class="w3-button w3-red w3-small">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Footer -->
<footer class="w3-container w3-grey w3-padding-30 w3-center">  
    <div class="w3-xlarge w3-padding-5 w3-margin-top w3-border-black"></div>
    <div class="w3-container w3-black w3-center w3-padding-10">
        <h5 class="w3-margin" style="font-style: italic; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;font-weight: 600;">Life is like a book that never ends. Chapters close, but not the book itself</h5>
    </div>
    <p>Group 11<a></a></p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
// Initialize DataTables
$(document).ready(function() {
    $('#stockTable').DataTable();
});

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
