<?php
// CONNECT TO DATABASE
$conn = new mysqli("localhost", "root", "", "web_eng");

// CHECK CONNECTION
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// GET USER DATA
$sql = "SELECT * FROM users ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Customer List</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f9f9f9;
            margin: 0;
            padding: 40px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            padding-top: 20px;
        }

        table {
            width: 90%;
            margin: auto;
            border-collapse: separate;
            border-spacing: 0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
        }

        thead {
            background: linear-gradient(90deg, #4facfe, #00f2fe);
            color: white;
        }

        th,
        td {
            padding: 15px 20px;
            text-align: center;
        }

        tbody tr {
            border-bottom: 1px solid #eee;
        }

        tbody tr:nth-child(even) {
            background-color: #f6f6f6;
        }

        tbody tr:hover {
            background-color: #e0f7fa;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        th:first-child,
        td:first-child {
            border-top-left-radius: 12px;
        }

        th:last-child,
        td:last-child {
            border-top-right-radius: 12px;
        }

        button {
            background-color: #4facfe;
            border: none;
            color: white;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        button:hover {
            background-color: #00c6ff;
        }

        button.delete-btn {
            background-color: #ff5e5e;
        }

        button.delete-btn:hover {
            background-color: #ff1e1e;
        }
    </style>

</head>

<body>
    <section id="header">
        <a href="#"><img src="img/logo.png" class="logo" alt=""></a>
        <div>
            <ul id="navbar">
                <li><a class="active" href="index.html">Home</a></li>
                <li><a href="shop.html">Shope</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>

                <li><a href="customer.php"> Customer </a></li>
                <li><a href="cart.html" id="shopping-bag"><i class="fas fa-shopping-cart"></i></a></li>
                <a href="#" id="close-icon"><i class="fas fa-times"></i></a>

            </ul>
        </div>
        <div id="mobile-menu">
            <a href="cart.html"> <i class="fas fa-shopping-cart"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>


    <h2 style="text-align: center;">Customer List</h2>
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Birthdate</th>
                <th>Gender</th>
                <th>Region</th>
                <th>Username</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>{$row['first_name']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['birthdate']}</td>
                <td>{$row['gender']}</td>
                <td>{$row['region']}</td>
                <td>{$row['username']}</td>
                
                <td><a href='update_user.php?id={$row['id']}'><button>Update</button></a></td>

                <td><a href='delete_user.php?id={$row['id']}' onclick=\"return confirm('Are you sure you want to delete this user?');\"><button class='delete-btn'>Delete</button></a></td>
                </tr>";

                }
            } else {
                echo "<tr><td colspan='6'>No users found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>

<?php $conn->close(); ?>