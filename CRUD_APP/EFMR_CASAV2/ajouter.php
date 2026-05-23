<?php

require_once("config.php");

$req="SELECT * FROM typebImmo";
$stmt=$cnx->prepare($req);
$stmt->execute();
$typesImmo=$stmt->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['send'])){
    $id_immobilier=$_POST['id_immobilier']??"";
    $titre=$_POST['titre']??"";
    $adresse=$_POST['adresse']??"";
    $prixlocation=$_POST['prixlocation']??"";
    $typeImmo=$_POST['typeImmo']??"";
    $disponible=$_POST['disponible']??"";
    $errors="";

    if(!empty($id_immobilier) && !empty($titre) && !empty($adresse) && !empty($prixlocation) && !empty($id_type) && !empty($disponible)){
        $req="
            INSERT INTO immobilier(titre,adresse,prixlocation,id_type,disponible)
            VALUES(?,?,?,?,?)
            ";
        $stmt=$cnx->prepare($req);
        $stmt->execute([$titre,$adresse,$prixlocation,$id_type,$disponible]);
        $errors="";
    }else{
        $errors="Tout les champs sont obligatoire !";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Ajouter un immobilier</h2>
        <?php
        if(!empty($errors)){?>
            <div class="alert alert-danger"><?= $errors;?></div>
        <?php }?>


        <form action="" method="POST">

            <div class="mb-3">
                <label for="titre">titre</label>
                <input type="text" name="titre" class="form-control">
            </div>

            <div class="mb-3">
                <label for="adresse">adresse</label>
                <input type="text" name="adresse" class="form-control">
            </div>

            <div class="mb-3">
                <label for="prixlocation">prix location</label>
                <input type="number" name="prixlocation" class="form-control">
            </div>

            <div class="mb-3">
                <label for="libelle">libelle</label>
                <select name="typeImmo" id="">
                    <?php foreach($typebImmo as $ti){?>
                        <option value="<?= $ti['id_type'];?>"><?= $ti['libelle'];?></option>
                    <?php };?>
                </select>
            </div>

            <div class="mb-3">
                <label for="disponible">disponibilité</label>
                <div class="row"><label for="non">NON</label><input type="radio" name="disponible" id="non" class="form-control"></div>
                <div class="row"><label for="oui">OUI</label><input type="radio" name="disponible" id="oui" class="form-control"></div>
            </div>

            <button type="submit" class="btn btn-primary" name="send">Envoyer</button>
            <a href="listerC.php" class="btn  btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>