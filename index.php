<?php

session_start(); // Otvorenie session

// Kontrola či už bol potvrdený formulár a či boli vyplnené obidva údaje aj username aj password
if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
    // Connect string do DB
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bartkoeshop";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Vyber hesla z DB podľa usera, ktorý sa prihlasuje
    $sql = "SELECT password FROM t_user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_POST['username']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        
        echo $_POST['password'];
        $row = $result->fetch_assoc();
        echo $row["password"];
        if (password_verify($_POST['password'], $row["password"])) {

            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = $_POST['username'];
            header("Location: welcome.php");
            exit();
        }
        else {
            echo "Wrong password.";
        }

    }
    else {
        echo "Wrong username.";
    }
    $message = "Wrong username or password."; // Generic error message
    $stmt->close();
    $conn->close();
}



      



echo '<html>';
echo '<head>';
echo '<title>Login Form</title>';
echo '<style>';
echo 'body { background-color: #9370DB; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }'; // Mírně fialové pozadí
echo '.login-form { text-align: center; background: white; padding: 20px; border-radius: 10px; width: 20%; min-width: 250px; }'; // Šířka boxu 20% obrazovky s minimální šířkou
echo 'h2 { color: #000; }';
echo 'input[type="text"], input[type="password"] { margin-bottom: 20px; display: block; width: calc(100% - 20px); padding: 10px; }'; // Styly vstupů
echo '</style>';
echo '</head>';
echo '<body>';
echo '<div class="login-form">';
echo '<h2>LOGIN</h2>';
echo '<form action="index.php" method="post">';
echo '<input type="text" name="username" placeholder="username" required autofocus>';
echo '<input type="password" name="password" placeholder="password" required>';
echo '<input type="submit" name="login">';
echo '<a href="register.php" id="Register">Register</a>';
echo '</form>';
echo '</div>';
echo '</body>';
echo '</html>';

?>

