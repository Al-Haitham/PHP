<?php
require_once('config.php');
$code=$_GET['code_pro'];

$sql="SELECT * FROM professeur WHERE code_pro=?";
$stmt=$cnx->prepare($sql);
$stmt->execute([$code]);
$ProfToEd=$stmt->fetch(PDO::FETCH_ASSOC);

if($_SERVER['RESUEST_METHOD']=="POST"){
    $code_pro=$_POST['code_pro']??"";
    $nom_pro=$_POST['nom_pro']??"";
    $adresse_pro=$_POST['adresse_pro']??"";
    $statut_pro=$_POST['statut_pro']??"";
    $date_naissance=$_POST['date_naissance']??"";
    $salaire=$_POST['salaire']??"";

    $sqlUp="UPDATE professeur
            SET code_pro=?,nom_pro=?,adresse_pro=?,statut_pro=?,date_naissance=?,salaire=?";
    $stmtUp=$cnx->prepare($sqlUp);
    $stmtUp->execute([$code_pro,$nom_pro,$adresse_pro,$statut_pro,$date_naissance,$salaire]);
    header('Location:lister.php');
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
        <input type="text" name="code_pro" value="<?= $ProfToEd['code_pro']??"" ?>" placeholder="code du professeur" required>
        <input type="text" name="nom_pro" value="<?= $ProfToEd['nom_pro']??"" ?>" placeholder="nom de professeur" required>
        <input type="text" name="adresse_pro" value="<?= $ProfToEd['adresse_pro']??"" ?>" placeholder="adresse de professeur" required>
        <div class="row" id="sts">
            <label for="sts">Choisir le statut du professeur</label>
            <div class="row">
                <input type="radio" id="stsP" name="statut_pro" value="permanent" <?= ($ProfToEd['status_pro']=='permanent')?'checked':''?>>
                <label for="stsP">permanent</label>
            </div>
            <div class="row">
                <input type="radio" id="stsV" name="statut_pro" value="vacataire" <?= ($ProfToEd['status_pro']=='vacataire')?'checked':''?>>
                <label for="stsV">vacataire</label>
            </div>
        </div>
        <div>
            <label for="date_naissance">
                Date naissance du professeur
                <input type="date" name="date_naissance" required value="<?= $ProfToEd['date_naissance']??''?>">
            </label>
        </div>
        <input type="number" name="salaire" placeholder="Salaire du professeur" value="<?= $ProfToEd['salaire']??'' ?>">
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>