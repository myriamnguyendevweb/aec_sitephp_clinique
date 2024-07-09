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
    <title>Page accueil</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Clinique Vétérinaire</h1>
    
    <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="animaux.php">Animaux</a></li>
        <li><a href="veterinaires.php">Vétérinaire</a></li>
    </ul>

    <h2>Affiche des animaux en format « carte »</h2>
    
    <div class="flex">     
        <?php
            $res = $mysqli->query("SELECT id, nom, date_naissance, type_animal FROM animaux ORDER BY nom;");
            while($row = $res->fetch_assoc()) {
        ?>
        <div class ="card">
            <img src="https://images.unsplash.com/photo-1507146426996-ef05306b995a?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Photo d'un animal">
            <h3><?=$row["nom"] ?></h3>
            <p><a href="fiche_animal.php?id=<?= $row['id'] ?>">Détail</a></p>
            <p><a href="mise_a_jour_animal.php?id=<?= $row['id'] ?>">Modifier</a></p>
            <p><a href="suppression_animal.php?id=<?= $row['id'] ?>">Supprimer</a></p>
        </div>
        <?php
            }
        ?>
    </div>

    
    
</body>
</html>