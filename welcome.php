<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitaj na stránke</title>
    <style>
        body { background-color: #9370DB; color: white; font-family: Arial, sans-serif; text-align: center; padding-top: 50px; }
        .logout-button { padding: 10px 20px; background-color: #f44336; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; }
    </style>
</head>
<body>
    <h1>Vitaj na stránke</h1>
    <p>Si úspešne prihlásený.</p>
    <form action="logout.php" method="post">
        <button type="submit" class="logout-button">Odhlásiť sa</button>
    </form>
</body>
</html>
