<?php
// Vérifie si les données 'nom', 'prenom' et 'age'.
if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['age'])) {
    // Si les données sont présentes,inclusion du fichier 'action.php'.
    include 'action.php';
} else {
    // Si les données ne sont PAS présentes, le formulaire n'a pas encore été soumis affichage du formulaire HTML
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