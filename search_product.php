<?php
// Connect to your database
$host = "localhost";
$user = "root";
$password = ""; // change if needed
$dbname = "web_eng"; // change this

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products
$sql = "SELECT product_name, price, size, quantity, image_url FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Product List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 2rem;
        }
        .product-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .product-card {
            width: 200px;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 2px 2px 8px rgba(0,0,0,0.1);
        }
        .product-card img {
            width: 100%;
            height: auto;
        }
        .product-details {
            padding: 10px;
        }
        .product-details h4 {
            margin: 0 0 5px;
        }
    </style>
</head>
<body>

<h2>Customer Product List</h2>

<div class="product-container">
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '
            <div class="product-card">
                <img src="' . htmlspecialchars($row["image_url"]) . '" alt="' . htmlspecialchars($row["product_name"]) . '">
                <div class="product-details">
                    <h4>' . htmlspecialchars($row["product_name"]) . '</h4>
                    <p>Price: $' . htmlspecialchars($row["price"]) . '</p>
                    <p>Size: ' . htmlspecialchars($row["size"]) . '</p>
                    <p>Qty: ' . htmlspecialchars($row["quantity"]) . '</p>
                </div>
            </div>';
        }
    } else {
        echo "<p>No products found.</p>";
    }
    ?>
</div>

</body>
</html>
