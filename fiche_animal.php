<?php
    include_once 'include/config.php';

    if(!isset($_GET['id'])) { // Vérification que la page reçoit un identifiant en paramètre
    echo'Identifiant manquant';
    exit();
    }

    $mysqli= new mysqli($host, $username, $password, $database); // Établissement de la connexion à la base de données
    if($mysqli-> connect_errno) { // Affichage d'une erreur si la connexion échoue
    echo'Échec de connexion à la base de données MySQL: '. $mysqli-> connect_error;
    exit();
    }

    if($requete= $mysqli->prepare("SELECT * FROM animaux WHERE id=?")) { // Création d'une requête préparée
    
        $requete->bind_param("i", $_GET['id']); // Envoi des paramètres à la requête
        $requete->execute(); // Exécution de la requête
            
        $result= $requete->get_result(); // Récupération de résultats de la requête
        $animal= $result->fetch_assoc(); // Récupération de l'enregistrement
        
        $requete->close(); // Fermeture du traitement
    }

    $mysqli->close(); // Fermeture de la connexion
?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche d'un animal</title>
    <link rel="stylesheet" href="css/style.css">
</head>
  <body>
    <h1>Fiche d'un animal</h1>
    <div class="card">
      <div class="card-body">
        <h3 class="card-title"><?= $animal["nom"] ?></h3>
        <h5 class="card-subtitle"><?= $animal["date_naissance"] ?></h6>
        <h5 class="card-subtitle"><?= $animal["type_animal"] ?></h6>
      </div>
    </div>
    <a href="index.php" >Retour à l'accueil</a>

  </body>
</html>