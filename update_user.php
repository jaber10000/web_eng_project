<?php
// CONNECT TO DATABASE
$conn = new mysqli("localhost", "root", "", "web_eng");

// CHECK CONNECTION
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// GET USER DATA BY ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit();
    }
}

// HANDLE FORM SUBMISSION
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $first = $_POST['first_name'];
    $last = $_POST['last_name'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $region = $_POST['region'];
    $username = $_POST['username'];

    $sql = "UPDATE users SET 
        first_name='$first', 
        last_name='$last', 
        birthdate='$birthdate', 
        gender='$gender', 
        region='$region', 
        username='$username' 
        WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: customer.php"); // Redirect after update
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            padding: 40px;
        }

        form {
            background: white;
            max-width: 500px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        }

        input[type="text"], input[type="date"], select {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        label {
            font-weight: bold;
            display: block;
        }

        button {
            background: #4facfe;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background: #00c6ff;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Update User Info</h2>

<form method="POST" action="">
    <input type="hidden" name="id" value="<?= $user['id'] ?>">

    <label>First Name</label>
    <input type="text" name="first_name" value="<?= $user['first_name'] ?>" required>

    <label>Last Name</label>
    <input type="text" name="last_name" value="<?= $user['last_name'] ?>" required>

    <label>Birthdate</label>
    <input type="date" name="birthdate" value="<?= $user['birthdate'] ?>" required>

    <label>Gender</label>
    <select name="gender" required>
        <option value="Male" <?= $user['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
        <option value="Female" <?= $user['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
        <option value="Other" <?= $user['gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
    </select>

    <label>Region</label>
    <input type="text" name="region" value="<?= $user['region'] ?>" required>

    <label>Username</label>
    <input type="text" name="username" value="<?= $user['username'] ?>" required>

    <button type="submit">Update</button>
</form>

</body>
</html>
