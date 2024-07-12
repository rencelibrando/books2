<?php
session_start();


include 'connect.php';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the form
$id = $_POST['id'];
$name = $_POST['name'];
$stock = $_POST['stock'];
$price = $_POST['price'];

// Prepare and bind the update query
$stmt = $conn->prepare("UPDATE stock SET name=?, stock=?, price=? WHERE ID=?");
$stmt->bind_param("sdsi", $name, $stock, $price, $id);

if ($stmt->execute()) {
    echo "Record updated successfully";
    // Redirect to login page after 2 seconds
    header("refresh:2;url=admin.php");
} else {
    echo "Error updating record: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
<?php
session_start();


include 'connect.php';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the form
$id = $_POST['id'];
$name = $_POST['name'];
$stock = $_POST['stock'];
$price = $_POST['price'];

// Prepare and bind the update query
$stmt = $conn->prepare("UPDATE stock SET name=?, stock=?, price=? WHERE ID=?");
$stmt->bind_param("sdsi", $name, $stock, $price, $id);

if ($stmt->execute()) {
    echo "Record updated successfully";
    // Redirect to login page after 2 seconds
    header("refresh:2;url=admin.php");
} else {
    echo "Error updating record: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
<?php
session_start();


include 'connect.php';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the form
$id = $_POST['id'];
$name = $_POST['name'];
$stock = $_POST['stock'];
$price = $_POST['price'];

// Prepare and bind the update query
$stmt = $conn->prepare("UPDATE stock SET name=?, stock=?, price=? WHERE ID=?");
$stmt->bind_param("sdsi", $name, $stock, $price, $id);

if ($stmt->execute()) {
    echo "Record updated successfully";
    // Redirect to login page after 2 seconds
    header("refresh:2;url=admin.php");
} else {
    echo "Error updating record: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
<?php
session_start();


include 'connect.php';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the form
$id = $_POST['id'];
$name = $_POST['name'];
$stock = $_POST['stock'];
$price = $_POST['price'];

// Prepare and bind the update query
$stmt = $conn->prepare("UPDATE stock SET name=?, stock=?, price=? WHERE ID=?");
$stmt->bind_param("sdsi", $name, $stock, $price, $id);

if ($stmt->execute()) {
    echo "Record updated successfully";
    // Redirect to login page after 2 seconds
    header("refresh:2;url=admin.php");
} else {
    echo "Error updating record: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
