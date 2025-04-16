<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['Gender'];
    $region = $_POST['Region'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Plain text password, as requested

    $query = "INSERT INTO users (first_name, last_name, birthdate, gender, region, username, password) 
              VALUES ('$firstName', '$lastName', '$birthdate', '$gender', '$region', '$username', '$password')";

    if (mysqli_query($conn, $query)) {
        header("Refresh: 0; URL=login.html");
    } else {
        echo "<script>alert('Error: Could not register.');</script>";
        header("Refresh: 0; URL=signup.html");
    }
}
?>
