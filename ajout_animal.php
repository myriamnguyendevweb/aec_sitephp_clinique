<?php
    include_once "include/config.php";

   $messageAjout = "Message qui sera généré selon le succès ou l'échec de l'ajout";

   // Vérification que la page a été soumise et que tous les champs sont présents
if(isset($_POST['nom']) && isset($_POST['date_naissance']) && isset($_POST['type_animal'])) {
    $mysqli= new mysqli($host, $username, $password, $database); // Établissement de la connexion à la base de données
    if($mysqli-> connect_errno) { // Affichage d'une erreur si la connexion échoue
    echo'Échec de connexion à la base de données MySQL: '. $mysqli-> connect_error;
    }
    
    // Création d'une requête préparée
    if($requete= $mysqli->prepare("INSERT INTO animaux(nom, date_naissance, type_animal) VALUES(?, ?, ?)")) {
    
    /************************* ATTENTION **************************/
    /* On ne fait présentement peu de validation des données. */
    /* On revient sur cette partie dans les prochaines semaines!! */
    /**************************************************************/
    
    $requete->bind_param("sddi", $_POST['nom'], $_POST['date_naissance'], $_POST['type_animal']);
    
    if($requete->execute()) { // Exécution de la requête
    $messageAjout= "<div class='alert alert-success'>Animal ajouté</div>"; // Message ajouté dans la page en cas d'ajout réussi
    } else{
      $messageAjout= "<div class ='alert alert-danger'> Un paramètre POST est manquant.</div>"; // Message ajouté dans la page en cas d’échec
      }
    
    $requete->close(); // Fermeture du traitement
    
    } else{
    echo $mysqli->error;
    }
    
    $mysqli->close(); // Fermeture de la connexion
    
    } else{
      $messageAjout= "<div class='alert alert-danger'>Veuillez remplir tous les champs du formulaire.</div>";// Message ajouté dans la page si la requête n'est pas soumise
    }
    
      echo $messageAjout; // Message ajouté dans la page en cas d'ajout réussi ou non
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche d'un animal</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Ajouter un animal</h1>

    <form method="POST">
        <div>
            <div>
                <label for="nomAnimal">Nom de l'animal</label>
                <input type="text" class="form-control" name="nom" id="nomAnimal" minlength="2" maxlength="25">
            </div>
        </div>

        <div>
            <div>
            <label for="type">Type</label>
            <input type ="text" class="form-control" name="type" id="type" minlength="2" maxlength="20">
            </div>
        </div>

        <div>
            <div>
                <label for="typeId">Type id animal</label>
                <select name="typeId" class="form-control"id="typeId">
                    <option value=""> Choisir le id de l'animal
                    </option>
                    <option value="1">1
                    </option>
                    <option value="2">2
                    </option>
                    <option value="3">3
                    </option>
                    <option value="4">4
                    </option>
                    <option value="5">5
                    </option>
                    <option value="6">6
                    </option>
                </select>
            </div>
        </div>


        <div>
            <div>
                <label for="proprietaireId">id du propriétaire correspondant à l'animal</label>
                <select name="proprietaireId" id="proprietaireId">
                    <option value=""> Choisir le id du propriétaire correspondant à l'animal
                    </option>
                    <option value="1">1
                    </option>
                    <option value="2">2
                    </option>
                    <option value="3">3
                    </option>
                    <option value="4">4
                    </option>
                    <option value="5">5
                    </option>
                    <option value="6">6
                    </option>
                </select>
            </div>
        </div>

        <div class=btn-envoyer>
            <button class="btn btn-primary" type="submit">Ajouter l'animal</button>
        </div>
        <div><a href="index.php" class="float-right">Retour à l'accueil</a></div>
        
        
    </form>
    
</body>
</html>