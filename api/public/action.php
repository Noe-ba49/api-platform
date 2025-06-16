<?php

// Vérifie si'nom', 'prenom' et 'age' son complete.
if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['age'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $age = (int) $_POST['age'];

    // Détermine majeur ou non
    $statutMajorite = ($age >= 18) ? "vous êtes majeur(e)." : "vous êtes mineur(e).";

    //Sauvegarde des données dans un fichier JSON

    $userData = [
        'nom' => $nom,
        'prenom' => $prenom,
        'age' => $age,
        'statutMajorite' => $statutMajorite
    ];

    $filename = 'data_' . strtolower($prenom) . '_' . strtolower($nom) . '.json';
    $filepath = __DIR__ . '/data/' . $filename; // Stocke dans 'data'

    if (!is_dir(__DIR__ . '/data')) {
        mkdir(__DIR__ . '/data', 0777, true); // Crée le répertoire
    }

    // Sauvegarde les données de l'utilisateur sous forme de JSON dans le fichier
    if (file_put_contents($filepath, json_encode($userData))) {
    } else {
        error_log("Erreur lors de la sauvegarde des données pour l'utilisateur : " . $prenom . " " . $nom);
    }

    echo "<!DOCTYPE html>";
    echo "<html>";
    echo "<head>";
    echo "    <title>Salutations !</title>";
    echo "    <meta charset='utf-8'>";
    echo "    <style>";
    echo "        body { font-family: Arial, sans-serif; margin: 20px; text-align: center; }";
    echo "        h1 { color: #007bff; }";
    echo "        p { font-size: 1.2em; }";
    echo "        .major { color:rgb(0, 255, 123); font-weight: bold; }"; // Style pour majeur
    echo "        .mineur { color:rgb(255, 234, 0); font-weight: bold; }"; // Style pour mineur
    echo "        .button {";
    echo "            display: inline-block;";
    echo "            background-color: #6c757d;";
    echo "            color: white;";
    echo "            padding: 10px 15px;";
    echo "            border: none;";
    echo "            border-radius: 4px;";
    echo "            text-decoration: none;"; /* Retire le soulignement */
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
    echo "    <h1>Bonjour, ".$prenom." ".$nom.".</h1>";
    echo "    <p>Tu as ".$age." ans.</p>";

    // Vérifie si vous êtes majeur ou pas
    echo "<p class='";
    echo ($age >= 18) ? "major" : "mineur";
    echo "'>En France, " . $statutMajorite . "</p>";

    // Lien pour "retour au formulaire"
    echo "    <a href='https://expert-space-waffle-pj6wwg7p455pc7xj-443.app.github.dev/docs' class='button'>Retour au formulaire</a>";
    // Nouveau lien pour "Voir mes données stockées"
    echo "    <a href='index.php?view_data=" . urlencode($filename) . "' class='button'>Voir mes données stockées</a>";


    echo "</body>";
    echo "</html>";

} else {
    // Si quelqu'un tente d'accéder directement à action.php sans remplir le formulaire, ou si les données sont manquantes
    header('Location: https://expert-space-waffle-pj6wwg7p455pc7xj-443.app.github.dev/docs');
    exit; // Arrête le script après la redirection
}
?>