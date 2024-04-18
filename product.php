<?php
// Získanie ID produktu z query string
$product_id = isset($_GET['id']) ? $_GET['id'] : 'Neznáme';

// Tu by ste zvyčajne získavali informácie o produkte z databázy podľa $product_id
// Na ilustráciu len zobrazíme ID na obrazovke
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail produktu</title>
</head>
<body>
    <h1>Detail produktu</h1>
    <p>ID produktu: <?php echo htmlspecialchars($product_id); ?></p>
    <p>Tu bude zobrazený detail produktu podľa ID.</p>
    <a href="welcome.php">Späť na hlavnú stránku</a>
</body>
</html>
