<?php
$servername = "localhost";
$username = "root";
$password = ""; // your DB password
$dbname = "web_eng"; // your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get input values
$product_name = $_POST['product_name'];
$price = $_POST['price'];
$size = $_POST['size'];
$quantity = $_POST['quantity'];
$image_url = $_POST['image_url'];

// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO products (product_name, price, size, quantity, image_url) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssis", $product_name, $price, $size, $quantity, $image_url);

// Execute and check
if ($stmt->execute()) {
    echo "Product added successfully!";
    // header("Location: success.html"); // optional redirect
} else {
    echo "Error: " . $stmt->error;
}

// Close
$stmt->close();
$conn->close();
?>
