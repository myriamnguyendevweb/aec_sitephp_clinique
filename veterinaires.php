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
    <title>Vétérinaires</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Liste des véterinaires</h1>

    <?php
        $res = $mysqli->query("SELECT prenom, nom FROM veterinaires ORDER BY nom");

        echo "<ul class='list-group listeVeterinaires'>";

        while ($row = $res->fetch_assoc()) {
            echo "<li class='list-group-item'>" . $row["nom"] . " " . $row["prenom"] . "</li>";
        }
    ?>
</body>
</html>