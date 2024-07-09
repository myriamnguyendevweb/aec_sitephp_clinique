<?php
    include_once "include/config.php";

    $mysqli = new mysqli($host, $username, $password, $database);
    // Vérifier la connexion
    if ($mysqli -> connect_errno) {
        echo "Échec lors de la connexion : " . $mysqli -> connect_error;
        exit();
    } else {
        echo "Connexion réeussie";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animaux</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Liste des animaux</h1>

    <?php
    $res = $mysqli->query("SELECT nom, date_naissance, type_animal FROM animaux ORDER BY nom");

    echo "<ul class='list-group liste'>";

    while ($row = $res->fetch_assoc()) {
        echo "<li class='list-group-item'>" . $row["nom"] . " - " . $row["date_naissance"] . " " .$row["type_animal"] . " </li>";
    }
    echo "</ul>";
?>
    <a href="ajout_animal.php">Ajouter un animal</a> <br>
    <a href="index.php">Retour à l'accueil</a>
    
</body>
</html>