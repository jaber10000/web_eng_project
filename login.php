<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password']; // Plain text password (match with what you stored)

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Login success
        echo "<script>alert('Login successful!');</script>";
        session_start();
        $_SESSION['username'] = $username;
        header("Refresh: 0; URL=index.html");
        exit();
    } else {
        echo "<script>alert('Invalid username or password');</script>";
        header("Refresh: 0; URL=login.html");
    }
}
?>
