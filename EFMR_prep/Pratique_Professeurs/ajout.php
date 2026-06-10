<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location:login.php");
    exit;
}
require_once("config.php");

if($_SERVER['REQUEST_METHOD']=='POST'){
    $code_pro=$_POST['code_pro'];
    $nom_pro=$_POST['nom_pro'];
    $adresse_pro=$_POST['adresse_pro'];
    $statut_pro=$_POST['statut_pro'];
    $date_naissance=$_POST['date_naissance'];
    $salaire=$_POST['salaire'];

    $error="";
    if(!$code_pro || !$nom_pro || !$adresse_pro || !$statut_pro || !$date_naissance || !$salaire){
        $error="Tous les champs sont obligtoires!";
        return;
    }

    if(!is_numeric($salaire)){
        $error="le salaire doit etre numeric";
        return;
    }
    

    $sql="INSERT INTO professeur (code_pro,nom_pro,statut_pro,adresse_pro,date_naissance,salaire) 
          VALUES (:code_pro,:nom_pro,:statut_pro,:adresse_pro,:date_naissance,:salaire)";
    $stmt=$cnx->prepare($sql);
    $stmt->execute(['code_pro'=>$code_pro,'nom_pro'=>$nom_pro,'statut_pro'=>$statut_pro,'adresse_pro'=>$adresse_pro,'date_naissance'=>$date_naissance,'salaire'=>$salaire]);

    header("Location:lister.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    
    <form method="POST">
        <?php
        if (!$error==""){ ?>
            <p class="alert alert-danger"><?= htmlspecialchars($_POST['error']) ?></p>
        <?php };?>
        <h4>gestion des professeurs</h4>
        <input type="text" name="code_pro" placeholder="code du professeur" required>
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
        <div>
            <label for="date_naissance">
                Date naissance du professeur
                <input type="date" name="date_naissance" required>
            </label>
        </div>
        <input type="number" name="salaire" placeholder="Salaire du professeur">
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>