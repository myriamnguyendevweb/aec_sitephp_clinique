<?php
    include_once 'include/config.php'; 
    
    // SECTION POUR LA MISE À JOUR
    $messageMAJ = '';

    // Vérification que la page a été soumise et que tous les champs sont présents
    if(isset($_POST['id']) && isset($_POST['nom']) && isset($_POST['date_naissance']) && isset($_POST['type_animal'])) { 
      $mysqli = new mysqli($host, $username, $password, $database); // Établissement de la connexion à la base de données
      if ($mysqli -> connect_errno) { // Affichage d'une erreur si la connexion échoue
          echo 'Échec de connexion à la base de données MySQL: ' . $mysqli -> connect_error;
      } 
      
      if ($requete = $mysqli->prepare("UPDATE animaux SET nom=?, date_naissance=?, type_animal=? WHERE nom=?")) {  // Création d'une requête préparée 
        
        /************************* ATTENTION **************************/
        /* On ne fait présentement peu de validation des données.     */
        /* On revient sur cette partie dans les prochaines semaines!! */
        /**************************************************************/
        $requete->bind_param("sddii", $_POST['nom'], $_POST['date_naissance'], $_POST['type_animal']); // Envoi des paramètres à la requête. 

        if($requete->execute()) { // Exécution de la requête
          $messageMAJ = "<div class='alert alert-success'>Produit mis à jour</div>";  // Message ajouté dans la page en cas d'ajout réussi
        } else {
          $messageMAJ =  "<div class='alert alert-danger'>Une erreur est survenue lors de la mise à jour.</div>";  // Message ajouté dans la page en cas d'ajout en échec
        }

        $requete->close(); // Fermeture du traitement
      } else  {
        echo $mysqli->error;
      }
  
      $mysqli->close(); // Fermeture de la connexion 
  
    } 

/*************************************************************************************************************** */
    // SECTION POUR L'AFFICHAGE
    if(!isset($_GET['id'])) { // Vérification que la page reçoit un identifiant en paramètre
      echo 'Identifiant manquant';
      exit();
    }

    $mysqli = new mysqli($host, $username, $password, $database); // Établissement de la connexion à la base de données
    if ($mysqli -> connect_errno) { // Affichage d'une erreur si la connexion échoue
        echo 'Échec de connexion à la base de données MySQL: ' . $mysqli -> connect_error;
        exit();
    } 

    if ($requete = $mysqli->prepare("SELECT * FROM animaux WHERE id=?")) {  // Création d'une requête préparée 

      $requete->bind_param("i", $_GET['id']); // Envoi des paramètres à la requête
      $requete->execute(); // Exécution de la requête

      $result = $requete->get_result(); // Récupération de résultats de la requête
      $animal = $result->fetch_assoc(); // Récupération de l'enregistrement

      $requete->close(); // Fermeture du traitement 
    }

    $mysqli->close(); // Fermeture de la connexion 
?>


<!DOCTYPE html>
<html lang="fr">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Mise à jour d'un produit</title>
      <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
	<div>
		<h1>Mise à jour du produit <?= $animal["nom"] ?></h1>
    
    <?php echo $messageMAJ ?>

		<form method="POST">
      <input type="hidden" id="id" name="id" value="<?= $animal["id"] ?>">
		  <div>
        <label for="nomAnimal">Nom de l'animal *</label>
        <!-- Attention! Vos validations doivent être cohérentes avec le champ correspondant dans la BD! -->
        <input type="text" class="form-control" id="nomAnimal" name="nomAnimal" required minlength="2" maxlength="25" value="<?= $animal["nom"] ?>">
      </div>
      
      <div class="flex">
        <div>
          <label for="date_naissance">Date de naissance *</label>
          <!-- Attention! Vos validations doivent être cohérentes avec le champ correspondant dans la BD! -->
          <input type="number"  class="form-control" id="date_naissance" name="date_naissance" required value="<?= $animal["date_naissance"] ?>">
        </div>

        <div>
          <label for="type_animal">Type d'animal *</label>
          <!-- Attention! Vos validations doivent être cohérentes avec le champ correspondant dans la BD! -->
          <input type="text" class="form-control" id="type_animal" name="type_animal" minlength="2" maxlength="20" required value="<?= $animal["type_animal"] ?>">
        </div>
      </div>

        <button class="btn btn-primary" type="submit">Modifier l'animal</button>
        <div><a href="index.php" class="float-right">Retour à l'accueil</a></div>
		</form>
	</div>
</body>
</html>