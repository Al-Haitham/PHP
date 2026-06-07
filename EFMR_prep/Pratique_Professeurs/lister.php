<?php
require_once('config.php');

$sql="SELECT * FROM professeur";

try{
    $stmt=$cnx->query($sql);
    $prof=$stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    die("Erreur: $getMessage($e");
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
    <h2>Liste des Professeurs</h2>
    <a href="ajout.php" class="btn btn-sm btn-primary" name="send">Ajouter</a>
    <table>
        <thead>
            <tr>
                <th>code_pro</th>
                <th>nom_pro</th>
                <th>statut_pro</th>
                <th>adresse_pro</th>
                <th>date_naissance</th>
                <th>salaire</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($prof as $p){ ?>
            <tr>
                <td><?= $p['code_Pro']; ?></td>
                <td><?= $p['code_Pro'];?></td>
                <td><?= $p['nom_Pro']; ?></td>
                <td><?= $p['Statut_Pro']; ?></td>
                <td><?= $p['Adresse_Pro']; ?></td>
                <td><?= $p['Date_Naissance']; ?></td>
                <td><?= $p['salaire']; ?></td>
            </tr>
            <?php };?>
        </tbody>
    </table>
</body>
</html>