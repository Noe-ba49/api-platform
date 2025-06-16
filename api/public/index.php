<?php

// Vérifie si des données sont demandées pour affichage (via le paramètre 'view_data')
if (isset($_GET['view_data'])) {
    $filename = basename($_GET['view_data']); // Nettoie pour éviter les attaques de traversée de répertoire
    $filepath = __DIR__ . '/data/' . $filename;

    if (file_exists($filepath)) {
        $jsonData = file_get_contents($filepath);
        $userData = json_decode($jsonData, true); // true pour un tableau associatif

        if ($userData) {
            echo "<!DOCTYPE html>";
            echo "<html>";
            echo "<head>";
            echo "    <title>Mes Données</title>";
            echo "    <meta charset='utf-8'>";
            echo "    <style>";
            echo "        body { font-family: Arial, sans-serif; margin: 20px; text-align: center; }";
            echo "        h1 { color: #007bff; }";
            echo "        p { font-size: 1.2em; }";
            echo "        .major { color:rgb(0, 255, 123); font-weight: bold; }";
            echo "        .mineur { color:rgb(255, 234, 0); font-weight: bold; }";
            echo "        .button {";
            echo "            display: inline-block;";
            echo "            background-color: #6c757d;";
            echo "            color: white;";
            echo "            padding: 10px 15px;";
            echo "            border: none;";
            echo "            border-radius: 4px;";
            echo "            text-decoration: none;";
            echo "            cursor: pointer;";
            echo "            font-size: 16px;";
            echo "            margin-top: 20px;";
            echo "        }";
            echo "        .button:hover {";
            echo "            background-color:rgb(27, 152, 247);";
            echo "            font-size: 18px;";
            echo "        }";
            echo "    </style>";
            echo "</head>";
            echo "<body>";
            echo "    <h1>Vos Données Stockées</h1>";
            echo "    <p>Nom: " . htmlspecialchars($userData['nom']) . "</p>";
            echo "    <p>Prénom: " . htmlspecialchars($userData['prenom']) . "</p>";
            echo "    <p>Âge: " . htmlspecialchars($userData['age']) . "</p>";
            echo "    <p class='";
            echo ($userData['age'] >= 18) ? "major" : "mineur";
            echo "'>En France, " . htmlspecialchars($userData['statutMajorite']) . "</p>";
            echo "    <a href='index.php' class='button'>Retour au formulaire</a>";
            echo "</body>";
            echo "</html>";
        } else {
            echo "Erreur lors du décodage des données utilisateur.";
        }
    } else {
        echo "Données utilisateur introuvables.";
    }
}
// Logique originale : Si le formulaire est soumis, inclure action.php ; sinon, afficher le formulaire.
else if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['age'])) {
    // Si les données sont présentes, inclure le fichier 'action.php'.
    include 'action.php';
} else {
    // Si les données ne sont PAS présentes, le formulaire n'a pas encore été soumis, affichage du formulaire HTML
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Exercice PHP - Formulaire</title>
        <meta charset="utf-8">
        <style>
            body { font-family: Arial, sans-serif; margin: 20px; }
            h1 { color: #333; }
            form { background-color: #f4f4f4; padding: 20px; border-radius: 8px; max-width: 400px; }
            label { display: block; margin-bottom: 8px; font-weight: bold; }
            input[type="text"],
            input[type="number"] {
                width: calc(100% - 22px);
                padding: 10px;
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 4px;
            }
            button[type="submit"] {
                background-color: #5cb85c;
                color: white;
                padding: 10px 15px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
            }
            button[type="submit"]:hover {
                background-color: #4cae4c;
            }
        </style>
    </head>
    <body>
       <h1>Bienvenue ! Veuillez remplir le formulaire.</h1>
       <form action="" method="post">
         <label for="nom">Votre nom :</label>
         <input name="nom" id="nom" type="text" required />

         <label for="prenom">Votre prénom :</label>
         <input name="prenom" id="prenom" type="text" required /> <label for="age">Votre âge :</label>
         <input name="age" id="age" type="number" required min="1" max="120" />

         <button type="submit">Valider</button>
       </form>
    </body>
</html>
<?php
}
?>