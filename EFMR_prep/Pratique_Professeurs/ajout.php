<?php
require_once("config.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form method="POST">
        <h4>gestion des professeurs</h4>
        <input type="text" name="code_pro" placeholder="code du professeur" require>
        <input type="text" name="nom_pro" placeholder="nom de professeur" required>
        <input type="text" name="adresse_pro" placeholder="adresse de professeur" required>
        <div class="row" id="sts">
            <label for="sts">Choisir le statut du professeur</label>
            <div class="row">
                <input type="radio" id="stsP" name="statut_pro" value="permanent">
                <label for="stsP">permanent</label>
            </div>
            <div class="row">
                <input type="radio" id="stsV" name="statut_pro" value="vacataire">
                <label for="stsV">vacataire</label>
            </div>
        </div>
    </form>
</body>
</html>