<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        header('Location: login.php');
        exit();
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="4gewintlogin.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="post">
            <div class="input-group">
                <label>Username:</label>
                <input type="text" name="username" required>
            </div>
            <div class="input-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
