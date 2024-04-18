<?php
session_start(); // Otvorenie session

// Kontrola, či boli odoslané údaje z formulára
if (isset($_POST['register']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['email'])) {
    // Kontrola zhodnosti hesiel
    if ($_POST['password'] == $_POST['confirm_password']) {
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

        // Príprava SQL príkazu na vloženie nového používateľa
        $sql = "INSERT INTO t_user (username, password, email) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash hesla pred uložením
        $stmt->bind_param("sss", $_POST['username'], $hashed_password, $_POST['email']);
        
        if ($stmt->execute()) {
            echo "User registered successfully.";
            // Tu môžeš presmerovať na prihlasovaciu stránku alebo kdekoľvek
            // header("Location: login.php");
            // exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Heslá sa nezhodujú.";
    }
}

echo '<html>';
echo '<head>';
echo '<title>Registration Form</title>';
echo '<style>';
echo 'body { background-color: #9370DB; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }';
echo '.login-form { text-align: center; background: white; padding: 20px; border-radius: 10px; width: 20%; min-width: 250px; }';
echo 'h2 { color: #000; }';
echo 'input[type="text"], input[type="password"], input[type="email"] { margin-bottom: 20px; display: block; width: calc(100% - 20px); padding: 10px; }';
echo '</style>';
echo '</head>';
echo '<body>';
echo '<div class="login-form">';
echo '<h2>REGISTER</h2>';
echo '<form action="register.php" method="post">';
echo '<input type="text" name="username" placeholder="username" required autofocus>';
echo '<input type="password" name="password" placeholder="password" required>';
echo '<input type="password" name="confirm_password" placeholder="confirm password" required>';
echo '<input type="email" name="email" placeholder="email" required>';
echo '<a href="index.php" id="login">Login</a>';
echo '<input type="submit" name="register" value="Register">';
echo '</form>';
echo '</div>';
echo '</body>';
echo '</html>';
?>
