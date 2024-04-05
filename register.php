<?php
session_start(); // Start the session.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dbloginbartko";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Check if the user or email already exists
    $checkUserSql = "SELECT * FROM t_user WHERE username = '$user' OR email = '$email'";
    $result = $conn->query($checkUserSql);

    $errorMessage = ""; // Initialize the error message variable

    if ($result->num_rows > 0) {
        $errorMessage = "Error: Username or Email already exists";
    } else {
        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password.

        $sql = "INSERT INTO t_user (username, password, email) VALUES ('$user', '$pass', '$email')";

        if ($conn->query($sql) === TRUE) {
            $conn->close(); // It's important to close the connection before redirection.
            // Redirect to welcome.php
            header("Location: welcome.php");
            exit();
        } else {
            $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Form</title>
    <style>
        body { background-color: #9370DB; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .register-form { text-align: center; background: white; padding: 20px; border-radius: 10px; width: 20%; min-width: 250px; }
        h2 { color: #000; }
        input[type="text"], input[type="password"], input[type="email"], input[type="submit"] { margin-bottom: 20px; display: block; width: calc(100% - 20px); padding: 10px; }
        .error-message { color: red; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="register-form">
        <h2>REGISTER</h2>
        <form action="" method="post">
            <input type="text" name="username" placeholder="Username" required autofocus>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Register">
            <a href="index.php" id="Login">Login</a>
        </form>
        <?php if (!empty($errorMessage)): ?>
            <div class="error-message"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
