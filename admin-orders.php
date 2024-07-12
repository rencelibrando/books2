<?php
// Start session
session_start();

include 'connect.php';
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit; // Ensure script stops execution after redirect
}

$user = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>KNOWLEDGE JUNCTION Book Store - Admin Orders</title>
<link rel="shortcut icon" type="image/x-icon" href="https://i.ibb.co/VgPWV0q/judith.png">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="header.css">
<script src="https://kit.fontawesome.com/38741bd1fa.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato|Montserrat&display=swap">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<style>
body, h1, h2, h3, h4, h5, h6 {
    font-family: 'Lato', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}
.w3-bar, h1, button {
    font-family: 'Montserrat', sans-serif;
}
.w3-top {
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.w3-bar .w3-button {
    background-color: #333;
    color: black;
}
.w3-button.active {
    background-color: #444;
    color: white;
}
.btn-edit, .btn-print {
    background-color: green;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
}
.btn-edit:hover, .btn-print:hover {
    background-color: #0056b3;
}
header {
    background-color: #000;
    color: black;
    padding: 20px;
    text-align: center;
}
header h1 {
    font-weight: 900;
    font-family: 'Times New Roman', Times, serif;
    border: 4px inset black;
    border-radius: 15px;
    display: inline-block;
    padding: 10px 20px;
}
header p {
    font-weight: bold;
    font-family: 'Times New Roman', Times, serif;
}
.container {
    padding: 64px;
    background-color: #fff;
    margin: 20px auto;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}
table, th, td {
    border: 1px solid #ddd;
}
th, td {
    padding: 12px;
    text-align: left;
}
th {
    background-color: #f2f2f2;
}
footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 30px;
    margin-top: 20px;
}
footer img {
    width: 50px;
}
footer p {
    margin: 0;
}
</style>
</head>
<body>

<!-- Navbar -->
<div class="w3-top">
    <div class="w3-bar w3-black w3-left-align w3-large w3-padding-small">
      <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
      <button onclick="window.location.href = 'admin.php';" class="w3-button w3-padding-large">Products</button>
      <button id="ordersButton" class="w3-button w3-padding-large active">Orders</button>
      <a href="logout.php" class="w3-bar-item w3-button w3-padding-large w3-large w3-right">Logout</a>
      <button onclick="printOrders()" class="w3-button w3-padding-large btn-print">Print Orders</button>
    </div>
  </div>
  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="admin.php" class="w3-bar-item w3-button w3-padding-large">Product</a>
    <a href="logout.php" class="w3-bar-item w3-button w3-padding-large">Logout</a>
  </div>
</div>

<!-- Header -->
<header class="w3-container w3-center">
  <h1>JJUNCTION ONLINE BOOK STORE</h1>
  <p>CUSTOMERS ORDERS!</p>
</header>

<!-- Main content -->
<div class="container w3-light-grey">
    <h2>Orders Details</h2>
    <div class="row mb-3">
        <div class="col-md-3">
            <select id="statusFilter" class="form-control">
                <option value="">-- Status --</option>
                <?php
                // Fetch distinct statuses for the dropdown
                $sql = "SELECT DISTINCT st.status AS order_status FROM status st";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['order_status']}'>{$row['order_status']}</option>";
                    }
                }
                ?>
            </select>
        </div>
    </div>
    <table id="ordersTable" class="display">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product Image</th>
                <th>Customer Name</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Payment Method</th>
                <th>Method of Transaction</th>
                <th>Status</th>
                <th>Address</th>
                <th>Contact #</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Fetch data from orders table along with product and user details
            $sql = "SELECT o.order_id, o.user_id, u.first_name, u.last_name, o.address, o.contact, o.product_id, o.quantity, o.status, o.payment, o.transac, s.name, s.price, s.stock, st.status AS order_status
            FROM orders o 
            INNER JOIN stock s ON o.product_id = s.product_id 
            INNER JOIN status st ON o.status = st.id
            INNER JOIN users u ON o.user_id = u.user_id";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Loop through each row
        while ($row = $result->fetch_assoc()) {
            $order_id = $row["order_id"];
            $product_id = $row["product_id"];
            $quantity = $row["quantity"];
            $product_name = $row["name"];
            $product_image = $row["product_id"];
            $product_price = $row["price"];
            $product_stock = $row["stock"];
            $order_status = $row["order_status"];
            $payment_method = $row["payment"];
            $transaction_method = $row["transac"];
            $first_name = $row["first_name"];
            $last_name = $row["last_name"];
            $address = $row["address"];
            $contact = $row["contact"];

            $prc = $product_price * $quantity;

            echo "<tr>";
            echo "<td>{$order_id}</td>";
            echo "<td><img src='{$product_image}.png' style='width: 100px;'></td>";
            echo "<td>{$first_name} {$last_name}</td>";
            echo "<td>{$product_name}</td>";
            echo "<td>{$quantity}</td>";
            echo "<td>{$prc}</td>";
            echo "<td>{$payment_method}</td>";
            echo "<td>{$transaction_method}</td>";
            echo "<td>{$order_status}</td>";
            echo "<td>{$address}</td>";
            echo "<td>{$contact}</td>";
            echo "<td>
                <a href='admin-edit-orders.php?id={$order_id}' class='btn btn-primary btn-edit'>Update</a>
                <a href='cancel_order.php?id={$order_id}' class='btn btn-danger btn-edit' onclick='return confirm(\"Are you sure you want to cancel this order?\")'>Cancel</a>
            </td>";
            echo "</tr>";              
        }  
    } else {
        echo "<tr><td colspan='12'>No items in the orders</td></tr>";
    }
?>

        </tbody>
    </table>
</div>

<!-- Footer -->
<footer class="w3-container w3-grey w3-padding-30 w3-center ">  
  <div class="w3-xlarge w3-padding-5 w3-margin-top w3-border-black">
    <img src="https://i.ibb.co/VgPWV0q/judith.png" alt="earist book store" class="logo">
 </div>
 <p>Group 11</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#ordersTable').DataTable();

    // Event listener for the dropdown filter
    $('#statusFilter').on('change', function () {
        table.column(8).search(this.value).draw();
    });
});

function printOrders() {
    // Print the entire page
    window.print();
}
</script>

</body>
</html>
