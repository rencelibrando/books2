<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL to delete record
    $sql_delete = "DELETE FROM stock WHERE ID = $id";

    if ($conn->query($sql_delete) === TRUE) {
        echo "Record deleted successfully";
        header("refresh:2;url=admin.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
