<?php
// CONNECT TO DATABASE
$conn = new mysqli("localhost", "root", "", "web_eng");

// CHECK CONNECTION
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// DELETE USER BY ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // REDIRECT TO CUSTOMER LIST AFTER DELETE
        header("Location: customer.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "No ID specified.";
}

$conn->close();
?>
