<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bartkoeshop";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_product"])) {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $image = $_FILES["image"]["tmp_name"];
    $imgContent = addslashes(file_get_contents($image));
    
    $sql = "INSERT INTO products (nazov, cena, obrazok) VALUES ('$name', '$price', '$imgContent')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Nový produkt bol úspešne pridaný";
    } else {
        echo "Chyba: " . $sql . "<br>" . $conn->error;
    }
}

// Delete product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_product"])) {
    $id = $_POST["id"];
    
    $sql = "DELETE FROM products WHERE id_product=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Produkt bol úspešne odstránený";
    } else {
        echo "Chyba: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body { 
            background-color: #241683; 
            color: white; 
            font-family: Arial, sans-serif; 
            text-align: center; 
            padding-top: 50px; 
        }
        .filter-form {
            margin: 20px auto;
            padding: 20px;
            background-color: #333;
            border-radius: 10px;
            display: inline-block;
            color: white;
        }
        select, input[type="text"], input[type="file"], input[type="number"] {
            width: 80%;
            padding: 10px;
            margin: 10px;
            border: 1px solid #555;
            border-radius: 5px;
            background-color: #fff;
            color: #333;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50; /* Green */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 20px;
        }
        .product-item {
            background: #FFFFFF;
            border-radius: 5px;
            padding: 10px;
            color: black;
            text-decoration: none;
            height: 320px; /* Upozornenie: Výška môže byť nastavená podľa vašich potrieb */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between; /* Rozdelí priestor medzi obrázkom a textom */
        }

        .product-item img {
            width: 30%;  /* Zachováva pôvodnú šírku 100% */
            max-height: 220px; /* Maximálna výška obrázka */
            object-fit: cover; /* Zabezpečí, aby obrázok pokryl celú dostupnú plochu */
            border-radius: 5px;
        }

        .product-name, .product-price {
            margin: 5px 0;
            text-align: center;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4285F4; /* Modrá farba */
            color: white;
            border: none;
            border-radius: 8px; /* Zaoblené rohy */
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease; /* Animácia na zmenu farby */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Jemný tieň pre 3D efekt */
        }

        input[type="submit"]:hover {
            background-color: #357ABD; /* Tmavšia modrá pri prejdení myšou */
        }

        .delete-form {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Admin Panel</h1>
    <div class="filter-form">
        <form action="admin.php" method="post" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Názov produktu" required>
            <input type="number" name="price" placeholder="Cena" required>
            <input type="file" name="image" accept="image/*" required>
            <input type="submit" name="add_product" value="Pridať">
        </form>
    </div>

    <h2>Zoznam produktov</h2>
    <div class="product-grid">
    <?php
        $sql = "SELECT id_product, nazov, cena, obrazok FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product-item">';
                echo '<img src="data:image/jpeg;base64,' . base64_encode($row['obrazok']) . '" alt="Product Image">';
                echo '<div class="product-name">' . htmlspecialchars($row['nazov']) . '</div>';
                echo '<div class="product-price">€' . htmlspecialchars($row['cena']) . '</div>';
                echo '<form class="delete-form" action="admin.php" method="post">';
                echo '<input type="hidden" name="id" value="' . htmlspecialchars($row['id_product']) . '">';
                echo '<input type="submit" name="delete_product" value="Odstrániť">';
                echo '</form>';
                echo '</div>';
            }
        } else {
            echo "No results found";
        }
        $conn->close();
    ?>
    </div>
</body>
</html>
